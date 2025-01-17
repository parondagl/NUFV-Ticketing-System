<?php include('db_connect.php') ?>
  
<style>

body {
    margin: 0;
    overflow: hidden;
    height: 100vh;
}

.section {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 75vh;
}

.services {
    width: 85%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 300px auto;
    text-align: center;
}

.card {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-direction: column;
    margin: 0px 50px;
    padding: 10px 0px;
    background-color: #34418E;
    border-radius: 10px;
    cursor: pointer;
}

.card:hover {
    background-color: lightslategray;
    transition: 0.4s ease;
}

.card .icon {
    font-size: 200px;
    margin-bottom: 10px;
    color: white;
}

.card h2 {
    font-size: 28px;
    font-weight: bolder;
    color: #FFD31C;
    margin-bottom: 20px;
}

@media screen and (max-width: 940px) {
    .services {
        display: flex;
        flex-direction: column;
    }
    .card {
        width: 85%;
        display: flex;
        margin: 10px 0px;
    }
}

.main {
    position: absolute;
    top: 60px;
    width: 100%;
    min-height: 100vh;
    background: #f5f5f5;
}

.cards {
    width: 100%;
    padding: 40px 20px;
    display: flex;
    justify-content: space-between;
    gap: 20px;
}

.cards .card {
    flex: 1;
    padding: 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 7px 25px 0 rgba(0, 0, 0, 0.08);
}

.cards .card:hover {
    background: rgba(52, 65, 142, 0.9);
}

.cards .card:hover .number,
.cards .card:hover .card-name,
.cards .card:hover .icon-box i {
    color: #fff;
}

.number {
    font-size: 50px;
    font-weight: 500;
    color: rgba(52, 65, 142, 0.9);
}

.card-name {
    color: #888;
    font-weight: 600;
    display: block;
    margin: 0 auto;
}

.icon-box i {
    font-size: 45px;
    color: rgba(52, 65, 142, 0.9);
}


.charts {
    display: grid;
    grid-template-columns: 2fr 1fr;
    grid-gap: 20px;
    width: 80%;
    padding: 10px;
    margin: 0 auto;
    margin-left: 35%;
}

.chart {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    top: -5px;
    box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
    width: 50%;
}

.chart h2 {
    margin-bottom: 5px;
    font-size: 20px;
    color: #666;
    text-align: center;
}


@media (max-width: 940px) {
    .services {
        display: flex;
        flex-direction: column;
    }

    .card {
        width: 85%;
        margin: 10px 0px;
    }
}

@media (max-width: 880px) {
    .cards {
        flex-direction: column;
        align-items: center;
    }

    .charts {
        grid-template-columns: 1fr;
    }

    #doughnut-chart,
    #doughnut {
        padding: 50px;
    }
}

@media (max-width: 500px) {
    .cards {
        flex-direction: column;
        align-items: center;
    }

    .logo h2 {
        font-size: 20px;
    }

    .search {
        width: 80%;
    }

    .search input {
        padding: 0 20px;
    }

    .fa-bell {
        margin-right: 5px;
    }

    .user {
        width: 40px;
        height: 40px;
    }

    #doughnut-chart,
    #doughnut {
        padding: 10px;
    }
}

</style>  
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<body>
  <div class="section">
    <div class="services">
      
      <?php if(in_array($_SESSION['login_type'], [1, 2])): ?>
        <a href="index.php?page=home" class="button">
          <div class="card">
            <div class="icon">
              <i class="fa-solid fa-chart-line"></i>                   
            </div>
            <h2>Dashboard</h2>
          </a>
        </div>
      <?php endif; ?>
      
      <a href="index.php?page=ticket_list" class="button">
        <div class="card">
          <div class="icon">
            <i class="fa-solid fa-ticket"></i>                      
          </div>
          <h2>Ticket List</h2>
        </a>
      </div>
      
      <?php if($_SESSION['login_type'] != 1 && $_SESSION['login_type'] != 2): ?>
        <a href="index.php?page=history" class="button">
          <div class="card">
            <div class="icon">
              <i class="fa-solid fa-history"></i>                      
            </div>
            <h2>Ticket History</h2>
        </a>
      </div>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>