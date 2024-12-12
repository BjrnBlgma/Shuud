@include('admin.headerAdmin')

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список турниров</title>
</head>
<body>
<div class="tournaments-container">
    <h1>Список турниров</h1>
    <table class="tournaments-table">
        <thead>
        <tr>
            <th>№</th>
            <th>Название турнира</th>
            <th>Статус</th>
            <th>Кол-во участников</th>
            <th>Дата начала</th>
            <th>Дата завершения</th>
            <th>Местоположение</th>
            <th>Создатель</th>
            <th>Ссылка на турнир</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($allCompetitions))
            @php $i=1 @endphp
            @foreach($allCompetitions as $tournament)
            <tr>
                <td>{{ $i++ }}</td>
                <td><a href="{{ route('info-tournament', $tournament->id) }}"> {{ $tournament->name }} </a></td>

                <td>
                    @switch($tournament->status)
                        @case('active')
                            <span class="status-active">Активен</span>
                            @break
                        @case('registration_of_athletes')
                            <span class="status-registration">Регистрация спортсменов</span>
                            @break
                        @case('completed')
                            <span class="status-completed">Завершен</span>
                            @break
                        @case('upcoming')
                            <span class="status-upcoming">Предстоящий</span>
                            @break
                    @endswitch
                </td>

                @if(!empty($tournament->tournamentParticipants))
                        <td style="text-align: center">
                            <a href=" {{route('list-of-participants', ["tournament_id" => $tournament->id] )}}">
                                 {{ count($tournament->tournamentParticipants) ?? '0' }}
                            </a>
                        </td>
                @else
                    <td style="text-align: center">
                        <a href="{{ route('add-athlete', ["tournament_id" => $tournament->id]) }}">
                            0
                        </a>
                    </td>
                @endif

                <td>{{ $tournament->start_date }}</td>
                <td>{{ $tournament->end_date }}</td>
                <td>{{ $tournament->location }}</td>
                <td>{{ $tournament->user->surname ?? ''}} {{$tournament->user->name ?? ''}}</td>
                <td>
                    @if(empty($tournament->registration_token))
                        <form method="POST" action="{{ route('generate-registration-link', ['tournament_id' => $tournament->id]) }}">
                            @csrf
                            <button type="submit" class="btnAdd" style="background-color: orange; color: white;">Создать ссылку</button>
                        </form>
                    @else
                        <div style="text-align: center; display: flex; flex-direction: column; gap: 1px;">
                            <input type="text" id="registration-link" value="{{ route('register-guest', ['tournament_id' => $tournament->id, 'registration_token' => $tournament->registration_token]) }}" readonly style="width: 100%; text-align: center;">
                            <button onclick="copyToClipboard()" class="btnAdd" style="background-color: green; color: white; margin-bottom: 5px; height: 30px; text-align: center">Скопировать ссылку</button>
                        </div>
                    @endif
                </td>
                <td>
                    <div class="cell cell-100 text-center">
                    <a href="{{ route('edit-post', $tournament->id) }}" class="btnEdit fa fa-pencil bg-1 text-fff"> Редактировать</a>
                    <a href="{{ route('delete-post', $tournament->id) }}" class="btnRemove fa fa-remove bg-1 text-fff" onclick="return confirm('Вы уверены?')"> Удалить</a>
                    </div>
                </td>
            </tr>
        @endforeach
        @endif
        </tbody>
    </table>
</div>
</body>
</html>

<script>
    function copyToClipboard() {
        const linkInput = document.getElementById('registration-link');
        linkInput.select();
        linkInput.setSelectionRange(0, 99999); // Для мобильных устройств
        document.execCommand('copy');
        alert('Ссылка скопирована в буфер обмена!');
    }
</script>


<style>
    body {
        font-family: Arial, sans-serif;
        line-height: 2;
        background-color: #f4f4f4;
        margin-left: auto;
        width: 1600px;
        padding: 20px;
    }
    .tournaments-container {
        background-color: white;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        padding: 20px;
        text-align: center;
    }
    .tournaments-table {
        width: 100%;
        border-collapse: collapse;
    }
    .tournaments-table th {
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }
    .tournaments-table td {
        border: 1px solid #ddd;
        padding: 12px;
    }
    .tournaments-table tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    .tournaments-table tr:hover {
        background-color: #e8e8e8;
    }
    .status-active {
        color: green;
        font-weight: bold;
    }
    .status-completed {
        color: gray;
    }
    .status-upcoming {
        color: orange;
    }
    .status-registration{
        color: blue;
    }


    .btnEdit, .btnRemove {
        padding: 0.5em;
        margin: 0 2px;
    }
    .btnAdd {
        padding: 10px 10px;
        font-size: 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    input#registration-link {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 5px 10px;
        font-size: 14px;
        color: #333;
    }
</style>
