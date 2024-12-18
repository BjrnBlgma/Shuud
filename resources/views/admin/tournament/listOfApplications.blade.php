@include('admin.headerAdmin')

    <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Заявки на участие</title>
</head>
<body>
<div class="container">
    <h1>Заявки на участие в турнире "{{ $tournament->name }}"</h1>
    <div class="back" style="color: black; text-align: left; margin-top: -20px; margin-bottom: 20px;">
        <a href="{{ route('info-tournament', $tournament->id) }}">&#11178; Вернуться назад</a>
    </div>
    <table class="tournaments-table">
        <thead>
        <tr>
            <th>№</th>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Регион</th>
            <th>Город</th>
            <th>Телефон</th>
            <th>Email</th>
            <th>Допуск к турниру</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @forelse($tournament->tournamentParticipants as $participant)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $participant->participant->name }}</td>
                <td>{{ $participant->participant->surname }}</td>
                <td>{{ $participant->participant->region }}</td>
                <td>{{ $participant->participant->city }}</td>
                <td>{{ $participant->participant->phone }}</td>
                <td>{{ $participant->participant->email }}</td>
                <td>
                    @if($participant->is_confirmed)
                        <span style="color: green">Допущен</span>
                    @else
                        <span style="color: red">Не допущен</span>
                    @endif
                </td>
                <td>
                    <div class="form-row">
                                <a href="{{ route('applications-allow', ['tournament_id' => $tournament->id, "participant_id" => $participant->participant->id ]) }}" class="btnAdd fa fa-plus bg-1 text-fff" style="margin-top: 10px;  margin-bottom: 15px;">
                                    Допустить к участию</a>
                                <br>
                                <a href="{{ route('applications-deny', ['tournament_id' => $tournament->id, "participant_id" => $participant->participant->id ]) }}" class="btnRemove fa fa-remove bg-1 text-fff"
                                   onclick="return confirm('Вы уверены?')"> Отказать</a>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" style="text-align: center">Заявок пока нет.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
</body>
</html>


<style>
    .container {
        margin: 100px auto 40px 220px; /* Учет фиксированного хедера и боковой панели */
        max-width: 80%;
        padding: 20px;
        background: #ffffff;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .tournaments-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-size: 14px;
        text-align: left;
    }

    .tournaments-table th,
    .tournaments-table td {
        padding: 10px 15px;
        border: 1px solid #ddd;
    }

    .tournaments-table thead th {
        background: #f5f5f5;
        font-weight: 600;
        color: #555;
    }

    .tournaments-table tbody tr:nth-child(even) {
        background: #f9f9f9;
    }

    .tournaments-table tbody tr:hover {
        background: #f1f7ff;
    }

    .tournaments-table tbody td span {
        font-weight: bold;
    }

    .tournaments-table tbody td span[style="color: green"] {
        color: #28a745; /* Яркий зеленый */
    }

    .tournaments-table tbody td span[style="color: red"] {
        color: #dc3545; /* Яркий красный */
    }

    @media screen and (max-width: 768px) {
        .container {
            margin: 120px 10px 20px 10px; /* Уменьшение отступов для мобильных устройств */
        }

        .tournaments-table {
            font-size: 12px;
        }

        .tournaments-table th,
        .tournaments-table td {
            padding: 8px;
        }
    }

</style>
