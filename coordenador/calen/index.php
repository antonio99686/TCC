<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="in.css">
    <link rel="stylesheet" href="../../css/navbar.css">
    <link rel="shortcut icon" href="../../img/img/calendario.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" media="screen"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="style.css" />
    <title>Calendário</title>
  </head>
  <body>
  <nav class="menu-lateral">

<div class="btn-expandir">
    <i class="bi bi-list" id="btn-exp"></i>
</div>
<!--btn-expandir-->

<ul>
    <li class="item-menu ativo">
        <a href="../dashboard.php">
            <span class="icon"><i class="bi bi-house-door"></i></span>
            <span class="txt-link"></span>
        </a>
    </li>

    <li class="item-menu">
        <a href="#">
            <span class="icon"><i class="bi bi-gear"></i></span>
            <span class="txt-link"></span>
        </a>
    </li>
    <li class="item-menu">
        <a href="#">
            <span class="icon"><i class="bi bi-person-circle"></i></span>
            <span class="txt-link"></span>
        </a>
    </li>
</ul>

</nav><!--menu-lateral-->
    <div class="container">
      <div class="left">
        <div class="calendar">
          <div class="month">
            <i class="fas fa-angle-left prev"></i>
            <div class="date"></div>
            <i class="fas fa-angle-right next"></i>
          </div>
          <div class="weekdays">
            <div>Domingo</div>
            <div>Segunda</div>
            <div>Terça</div>
            <div>Quarta</div>
            <div>Quinta</div>
            <div>Sexta</div>
            <div>Sábado</div>
          </div>
          <div class="days"></div>
          <div class="goto-today">
            <div class="goto">
              <input type="text" placeholder="mm/yyyy" class="date-input" />
              <button class="goto-btn">Ir</button>
            </div>
            <button class="today-btn">Hoje</button>
          </div>
        </div>
      </div>
      <div class="right">
        <div class="today-date">
          <div class="event-day"></div>
          <div class="event-date"></div>
        </div>
        <div class="events"></div>
        <div class="add-event-wrapper">
          <div class="add-event-header">
            <div class="title">Adicionar Evento</div>
            <i class="fas fa-times close"></i>
          </div>
          <div class="add-event-body">
            <div class="add-event-input">
              <input type="text" placeholder="Nome do evento" class="event-name" />
            </div>
            <div class="add-event-input">
              <input
                type="text"
                placeholder="Hora do evento a partir de"
                class="event-time-from"
              />
            </div>
            <div class="add-event-input">
              <input
                type="text"
                placeholder="Hora do evento até"
                class="event-time-to"
              />
            </div>
          </div>
          <div class="add-event-footer">
            <button class="add-event-btn">Adicionar Evento</button>
          </div>
        </div>
      </div>
      <button class="add-event">
        <i class="fas fa-plus"></i>
      </button>
    </div>

   
    <script src="script.js"></script>
    <script src="../../java/dash.js"></script>
  </body>
</html>