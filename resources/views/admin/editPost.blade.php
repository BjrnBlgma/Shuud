@include('admin.headerAdmin')

<main role="main" class="edit-post-container">
    <section class="post-view">
        <article class="post">
            <h2 class="post-title" id="current-title">{{ $post->title }}</h2>
            <div class="post-content" id="current-content">
                @foreach (explode("\n", $post->content) as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
            </div>

            @if(!empty($post->postFile))
                <div class="post-images">

                    @foreach($post->postFile as $file)
                        <div class="image-container">
                            <img src="{{ asset('storage/' . $file->file->path) }}" alt="Post Image" class="post-image">
                        </div>
                    @endforeach
                </div>
            @endif

            <button id="edit-toggle-btn" class="primary-btn">Редактировать</button>
            <button type="button" class="secondary-btn"  onclick="window.history.back();">Отмена</button>
        </article>
    </section>


    <section id="edit-form" class="edit-form" style="display: none;">
        <form action="{{ route('edit-post', $post->id) }}" method="post" class="add-post-form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="author_id" value="{{ $post->author_id }}">
            <input type="hidden" name="post_id" value="{{ $post->id }}">

            <div class="edit-section">
                <label for="edit-title">Заголовок:</label>
                <input type="text" id="edit-title" name="title" value="{{ $post->title }}">
            </div>

            <div class="edit-section">
                <label for="edit-content">Содержание:</label>
                <textarea id="edit-content" name="content">{{ $post->content }}</textarea>
            </div>

            <div class="edit-section image-edit">
                <label>Изображения:</label>
                <div class="current-images">
                    @if(!empty($post->postFile))
                        @foreach($post->postFile as $file)
                            <div class="image-container" data-file-id="{{ $file->file->id }}">
                                <img src="{{ asset('storage/' . $file->file->path) }}" alt="Post Image">
                                <button type="button" class="remove-image-btn" data-file-id="{{ $file->file->id }}">✕</button>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="image-upload">
                    <input type="file" id="image-upload" name="image[]" multiple accept="image/*">
                    <label for="image-upload" class="upload-btn">Добавить фотографии</label>
                </div>
            </div>

            <input type="hidden" name="deleted_images" id="deleted-images-input" value="">

            <div class="edit-actions">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <button type="submit" id="save-changes-btn" class="primary-btn">Сохранить изменения</button>
                <button type="button" id="cancel-edit-btn" class="secondary-btn">Отмена</button>
            </div>
        </form>
    </section>
</main>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const editToggleBtn = document.getElementById('edit-toggle-btn');
        const editForm = document.querySelector('.add-post-form');
        const editFormSection = document.getElementById('edit-form');
        const cancelEditBtn = document.getElementById('cancel-edit-btn');
        const imageUpload = document.getElementById('image-upload');
        const currentImagesContainer = document.querySelector('.current-images');
        const deletedImagesInput = document.getElementById('deleted-images-input');

        // Множество для отслеживания удаляемых изображений
        const imagesToDelete = new Set();

        // Toggle edit mode
        editToggleBtn.addEventListener('click', () => {
            document.querySelector('.post-view').style.display = 'none';
            editFormSection.style.display = 'block';
        });

        // Cancel edit mode
        cancelEditBtn.addEventListener('click', () => {
            document.querySelector('.post-view').style.display = 'block';
            editFormSection.style.display = 'none';
        });

        // Обработчик удаления изображений
        currentImagesContainer.addEventListener('click', (e) => {
            if (e.target.classList.contains('remove-image-btn')) {
                const imageContainer = e.target.closest('.image-container');
                const imageId = imageContainer.dataset.fileId;

                if (imageId) {
                    // Добавляем или удаляем идентификатор из списка
                    imagesToDelete.add(imageId);

                    // Удаляем контейнер изображения
                    imageContainer.remove();

                    // Обновляем скрытое поле для передачи удаляемых изображений
                    deletedImagesInput.value = JSON.stringify(Array.from(imagesToDelete));

                    console.log('Удаляемые изображения:', deletedImagesInput.value);
                }
            }
        });

        // Превью новых изображений
        imageUpload.addEventListener('change', (e) => {
            const files = e.target.files;
            for (let file of files) {
                const reader = new FileReader();
                reader.onload = (event) => {
                    const imageContainer = document.createElement('div');
                    imageContainer.classList.add('image-container', 'new-image');
                    imageContainer.innerHTML = `
                    <img src="${event.target.result}" alt="Новое изображение">
                    <button type="button" class="remove-image-btn">✕</button>
                `;
                    currentImagesContainer.appendChild(imageContainer);
                };
                reader.readAsDataURL(file);
            }

        });
    });
</script>

<style>
    body {
        background-color: #f4f6f9;
    }

    .edit-post-container {
        display: flex;
        justify-content: center;
        padding: 20px;
    }

    .post-view, .edit-form {
        width: 100%;
        max-width: 800px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .post-title {
        font-size: 1.5em;
        color: #333;
        margin-bottom: 15px;
        text-align: center;
    }

    .post-content {
        color: #666;
        line-height: 1.6;
    }

    .post-images {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 15px;
    }

    .image-container {
        position: relative;
        width: 150px;
        height: 150px;
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
    }

    .primary-btn, .secondary-btn {
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .primary-btn {
        background-color: #007bff;
        color: white;
        margin-top: 20px;
    }

    .primary-btn:hover {
        background-color: #0056b3;
    }

    .secondary-btn {
        background-color: #6c757d;
        color: white;
        margin-left: 10px;
    }

    .secondary-btn:hover {
        background-color: #545b62;
    }

    .edit-form {
        background-color: #f8f9fa;
    }

    .edit-section {
        margin-bottom: 15px;
    }

    .edit-section label {
        display: block;
        margin-bottom: 5px;
        color: #495057;
    }

    .edit-section input,
    .edit-section textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }

    .edit-section textarea {
        min-height: 200px;
    }

    .image-edit .current-images {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 15px;
    }

    .image-edit .image-container {
        position: relative;
    }

    .remove-image-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: rgba(255, 0, 0, 0.7);
        color: white;
        border: none;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .image-upload {
        position: relative;
        overflow: hidden;
        display: inline-block;
    }

    .upload-btn {
        display: inline-block;
        padding: 10px 15px;
        background-color: #28a745;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    #image-upload {
        position: absolute;
        left: -9999px;
    }

    .edit-actions {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }


</style>
