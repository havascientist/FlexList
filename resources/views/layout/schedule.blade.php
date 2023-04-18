<?php
session_start();
include 'koneksi.php';
if (isset($_SESSION['user'])) {
    $check_akun = mysqli_query($koneksi, "SELECT * FROM akun WHERE username = '".$_SESSION['user']['username']."'");
    $data_akun = mysqli_fetch_assoc($check_akun);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FlexList</title>
    <link rel="stylesheet" href="templet/assets/css/style.css">
    <link rel="stylesheet" href="templet/assets/css/fontawesome.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
    <script src="https://davin.id/assets/js/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href=templet/images/flexbesar.png type="image/x-icon"/>
    <style>
body {font-family: Arial, Helvetica, sans-serif;}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>
<!-- ////////////////////////////////////////////////////////////////////////////////////////
                               START SECTION 1 - THE NAVBAR SECTION  
/////////////////////////////////////////////////////////////////////////////////////////////-->
<nav class="navbar navbar-expand-lg navbar-dark menu shadow fixed-top">
    <div class="container">
      <a class="navbar-brand" href="">
        <img src="templet/images/flexlist.png" alt="logo image" width="100px" height="100px"> <!-- ngecilin logo nya gimana-->
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#todolis" >To Do List</a></li>
          <li class="nav-item"><a class="nav-link" href="#Schedule">Schedule</a></li>
          <li class="nav-item"><a class="nav-link" href="#notes">Notes</a></li>
          <li class="nav-item"><a class="nav-link" href="#faq">QnA</a></li>
          <li class="nav-item"><a class="nav-link" href="#contact">Contact Us</a>
          </li>
        </ul>
        <? if (isset($_SESSION['user'])) { ?>
        <a href="logout.php" class="rounded-pill btn-rounded">
          Logout
          <span>
            <i class="fas fa-sign-in-alt"></i>
          </span>
        </a>
        <? } else { ?>
        <button onclick="document.getElementById('id01').style.display='block'" class="rounded-pill btn-rounded">
          Login
          <span>
            <i class="fas fa-sign-in-alt"></i>
          </span>
        </button>
        <? } ?>
      </div>
    </div>
  </nav>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////
                            START SECTION 2 - THE INTRO SECTION  
/////////////////////////////////////////////////////////////////////////////////////////////////////-->

<section id="home" class="intro-section">
  <div class="container">
    <div class="row align-items-center text-white"> <!-- kasih warna nya disini ygy -->
      <!-- START THE CONTENT FOR THE INTRO  -->
      <div class="col-md-6 intros text-start">
        <h1 class="display-2">
          <span class="display-2--intro"><?php if (isset($_SESSION['user'])) { echo 'Hello '.$data_akun['nama']; } else { echo 'Welcome to FlexList'; } ?></span>
          <span class="display-2--description lh-base">
            FlexList merupakan aplikasi berbasis web di mana user dapat membuat to do list/planning.
          </span>
        </h1>
        <a href="#daftar"><button type="button" class="rounded-pill btn-rounded"> Daftar
          <span><i class="fas fa-arrow-right"></i></span>
        </button> </a>
      </div>
      <!-- START THE CONTENT FOR THE VIDEO -->
      <div class="col-md-6 intros text-end">
        <div class="video-box">
          <img src="templet/images/lagilagi.png" alt="video illutration" class="img-fluid" width="2000px" height="1500">
          <a href="#" class="glightbox position-absolute top-50 start-50 translate-middle">          
          </a>
        </div>
      </div>
    </div>
  </div>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,160L48,176C96,192,192,224,288,208C384,192,480,128,576,133.3C672,139,768,213,864,202.7C960,192,1056,96,1152,74.7C1248,53,1344,107,1392,133.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
</section>

<!-- //////////////////////////////////////////////////////////////////////////////////////////////
                         START SECTION 4 - THE SERVICES  
///////////////////////////////////////////////////////////////////////////////////////////////////-->
<section id="services" class="services">
  <div class="container">
    <div class="row text-center">
      <h1 class="display-1 fw-bold">Introduce</h1>
      <div class="heading-line mb-1"></div>
    </div>
  <!-- START THE DESCRIPTION CONTENT  -->
    <div class="row pt-2 pb-2 mt-0 mb-3">
      <div class="col-md-6 border-right">
        <div class="bg-white p-3">
          <h2 class="fw-bold text-capitalize text-center">
            Our Services Range From Initial To Manage Your Proceedings Anywhere Anytime
          </h2>
        </div>
      </div>
      <div class="col-md-6">
        <div class="bg-white p-4 text-start">
          <p class="fw-light">
           Di era sekarang dimana semua serba digital, pencatatan manajemen waktu ataupun rencana/planning tentu dapat pula di lakukan secara digital. Aplikasi ini dilatarbelakangi oleh kebutuhan harian user tentang manajemen rencana yang mana bertujuan meningkatkan produktivitas user serta untuk mengorganisir tugas-tugas ataupun prioritas user (dengan cara pengurutan). Di lengkapi dengan fitur-fitur tambahan selain pencatatan /list prioritas user yang mana dapat semakin menunjang fungsi utama dari aplikasi.
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- START THE CONTENT FOR THE SERVICES  -->
  <div class="container">
    <!-- START THE MARKETING CONTENT  -->
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 services mt-4">
        <div class="services__content">
          <div class="icon d-block fas fa-clipboard-list"></div>
          <h3 class="display-3--title mt-1">Notes</h3>
          <p class="lh-lg">
            Notes merupakan salah satu fitur FlexList dimana anda dapat mencatat/menulis catatan anda dalam bentuk online sehingga dapat di akses kapanpun dan di manapun.
          </p>
         
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 services mt-4 text-end">
        <div class="services__pic">
          <img src="templet/images/services/service-1.png" alt="marketing illustration" class="img-fluid">
        </div>
      </div>
    </div>
    <!-- START THE WEB DEVELOPMENT CONTENT  -->
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 services mt-4 text-start">
        <div class="services__pic">
          <img src="templet/images/services/service-2.png" alt="web development illustration" class="img-fluid">
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 services mt-4">
        <div class="services__content">
          <div class="icon d-block fas fa-clock"></div>
          <h3 class="display-3--title mt-1">Schedule</h3>
          <p class="lh-lg">
            FlexList menyediakan fitur Schedule dimana anda dapat melakukan perencanaan jadwal keseharian dan memvisualisasikannya dalam fitur ini. 
          </p>
          
        </div>
      </div>
    </div>
    <!-- START THE CLOUD HOSTING CONTENT  -->
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 services mt-4">
        <div class="services__content">
          <div class="icon d-block fas fa-server"></div>
          <h3 class="display-3--title mt-1">To Do</h3>
          <p class="lh-lg">
            Merupakan fitur utama FlexList. Dimana anda dapat membuat perencanaan baik jangka pendek hingga jangka panjang dalam bentuk list-list.
          </p>
          
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 services mt-4 text-end">
        <div class="services__pic">
          <img src="templet/images/services/service-3.png" alt="cloud hosting illustration" class="img-fluid">
        </div>
      </div>
    </div>
  </div>
</section>



<!-- /////////////////////////////////////////////////////////////////////////////////////////////////
                                            {{-- TO DO LIST--}}
 ///////////////////////////////////////////////////////////////////////////////////////////-->
<section id="todolis" class="todolis">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,96L48,128C96,160,192,224,288,213.3C384,203,480,117,576,117.3C672,117,768,203,864,202.7C960,203,1056,117,1152,117.3C1248,117,1344,203,1392,245.3L1440,288L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
  <div class="container">
    <!DOCTYPE html>
    <!-- Coding By CodingNepal - youtube.com/codingnepal -->
    <html lang="en" dir="ltr">
      <head>
        <meta charset="utf-8">  
        <title>To do List </title>
        <!-- <link rel="stylesheet" href="style.css"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Iconscout Link For Icons -->
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
        <style>
        /* Import Google Font - Poppins */
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
            *{
              margin: 0;
              padding: 0;
              box-sizing: border-box;
              font-family: 'Poppins', sans-serif;
            }
            .mantapu{
              max-width: 405px;
              padding: 28px 0 30px;
              margin: 137px auto;
              background: #fff;
              border-radius: 7px;
              box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            }
            .task-input{
              height: 52px;
              padding: 0 25px;
              position: relative;
            }
            .task-input img{
              top: 50%;
              position: absolute;
              transform: translate(17px, -50%);
            }
            .task-input input{
              height: 100%;
              width: 100%;
              outline: none;
              font-size: 18px;
              border-radius: 5px;
              padding: 0 20px 0 53px;
              border: 1px solid #999;
            }
            .task-input input:focus,
            .task-input input.active{
              padding-left: 52px;
              border: 2px solid #3C87FF;
            }
            .task-input input::placeholder{
              color: #bfbfbf;
            }
            .controls, li{
              display: flex;
              align-items: center;
              justify-content: space-between;
            }
            .controls{
              padding: 18px 25px;
              border-bottom: 1px solid #ccc;
            }
            .filters span{
              margin: 0 8px;
              font-size: 17px;
              color: #444444;
              cursor: pointer;
            }
            .filters span:first-child{
              margin-left: 0;
            }
            .filters span.active{
              color: #3C87FF;
            }
            .controls .clear-btn{
              border: none;
              opacity: 0.6;
              outline: none;
              color: #fff;
              cursor: pointer;
              font-size: 13px;
              padding: 7px 13px;
              border-radius: 4px;
              letter-spacing: 0.3px;
              pointer-events: none;
              transition: transform 0.25s ease;
              background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);
            }
            .clear-btn.active{
              opacity: 0.9;
              pointer-events: auto;
            }
            .clear-btn:active{
              transform: scale(0.93);
            }
            .task-box{
              margin-top: 20px;
              margin-right: 5px;
              padding: 0 20px 10px 25px;
            }
            .task-box.overflow{
              overflow-y: auto;
              max-height: 300px;
            }
            .task-box::-webkit-scrollbar{
              width: 5px;
            }
            .task-box::-webkit-scrollbar-track{
              background: #f1f1f1;
              border-radius: 25px;
            }
            .task-box::-webkit-scrollbar-thumb{
              background: #e6e6e6;
              border-radius: 25px;
            }
            .task-box .task{
              list-style: none;
              font-size: 17px;
              margin-bottom: 18px;
              padding-bottom: 16px;
              align-items: flex-start;
              border-bottom: 1px solid #ccc;
            }
            .task-box .task:last-child{
              margin-bottom: 0;
              border-bottom: 0;
              padding-bottom: 0;
            }
            .task-box .task label{
              display: flex;
              align-items: flex-start;
            }
            .task label input{
              margin-top: 7px;
              accent-color: #3C87FF;
            }
            .task label p{
              user-select: none;
              margin-left: 12px;
              word-wrap: break-word;
            }
            .task label p.checked{
              text-decoration: line-through;
            }
            .task-box .settings{
              position: relative;
            }
            .settings :where(i, li){
              cursor: pointer;
            }
            .settings .task-menu{
              z-index: 10;
              right: -5px;
              bottom: -65px;
              padding: 5px 0;
              background: #fff;
              position: absolute;
              border-radius: 4px;
              transform: scale(0);
              transform-origin: top right;
              box-shadow: 0 0 6px rgba(0,0,0,0.15);
              transition: transform 0.2s ease;
            }
            .task-box .task:last-child .task-menu{
              bottom: 0;
              transform-origin: bottom right;
            }
            .task-box .task:first-child .task-menu{
              bottom: -65px;
              transform-origin: top right;
            }
            .task-menu.show{
              transform: scale(1);
            }
            .task-menu li{
              height: 25px;
              font-size: 16px;
              margin-bottom: 2px;
              padding: 17px 15px;
              cursor: pointer;
              justify-content: flex-start;
            }
            .task-menu li:last-child{
              margin-bottom: 0;
            }
            .settings li:hover{
              background: #f5f5f5;
            }
            .settings li i{
              padding-right: 8px;
            }
            
            @media (max-width: 400px) {
              body{
                padding: 0 10px;
              }
              .mantapu {
                padding: 20px 0;
              }
              .filters span{
                margin: 0 5px;
              }
              .task-input{
                padding: 0 20px;
              }
              .controls{
                padding: 18px 20px;
              }
              .task-box{
                margin-top: 20px;
                margin-right: 5px;
                padding: 0 15px 10px 20px;
              }
              .task label input{
                margin-top: 4px;
              }
            }</style>
      </head>
      <body>
        <center> <h1 class="display-3 fw-bold">To Do List</h1></center> <br>
        <hr style="width: 700px; height: 5px; " class="mx-auto">
        <div class="mantapu">
            
                <div class="task-input">
            <input type="text" placeholder="Tambah list anda disini..">
          </div> 
          <div class="controls">
            <div class="filters">
              <span class="active" id="all">All</span>
              <span id="pending">Pending</span>
              <span id="completed">Completed</span>
            </div>
            <button class="clear-btn">Clear All</button>
          </div>
          <ul class="task-box"></ul>
        </div>
        <script >
    
    const taskInput = document.querySelector(".task-input input"),
    filters = document.querySelectorAll(".filters span"),
    clearAll = document.querySelector(".clear-btn"),
    taskBox = document.querySelector(".task-box");
    
    let editId,
    isEditTask = false,
    todos = JSON.parse(localStorage.getItem("todo-list"));
    
    filters.forEach(btn => {
        btn.addEventListener("click", () => {
            document.querySelector("span.active").classList.remove("active");
            btn.classList.add("active");
            showTodo(btn.id);
        });
    });
    
    function showTodo(filter) {
        let liTag = "";
        if(todos) {
            todos.forEach((todo, id) => {
                let completed = todo.status == "completed" ? "checked" : "";
                if(filter == todo.status || filter == "all") {
                    liTag += `<li class="task">
                                <label for="${id}">
                                    <input onclick="updateStatus(this)" type="checkbox" id="${id}" ${completed}>
                                    <p class="${completed}">${todo.name}</p>
                                </label>
                                <div class="settings">
                                    <i onclick="showMenu(this)" class="uil uil-ellipsis-h"></i>
                                    <ul class="task-menu">
                                        <li onclick='editTask(${id}, "${todo.name}")'><i class="uil uil-pen"></i>Edit</li>
                                        <li onclick='deleteTask(${id}, "${filter}")'><i class="uil uil-trash"></i>Delete</li>
                                    </ul>
                                </div>
                            </li>`;
                }
            });
        }
        taskBox.innerHTML = liTag || `<span>You don't have any task here</span>`;
        let checkTask = taskBox.querySelectorAll(".task");
        !checkTask.length ? clearAll.classList.remove("active") : clearAll.classList.add("active");
        taskBox.offsetHeight >= 300 ? taskBox.classList.add("overflow") : taskBox.classList.remove("overflow");
    }
    showTodo("all");
    
    function showMenu(selectedTask) {
        let menuDiv = selectedTask.parentElement.lastElementChild;
        menuDiv.classList.add("show");
        document.addEventListener("click", e => {
            if(e.target.tagName != "I" || e.target != selectedTask) {
                menuDiv.classList.remove("show");
            }
        });
    }
    
    function updateStatus(selectedTask) {
        let taskName = selectedTask.parentElement.lastElementChild;
        if(selectedTask.checked) {
            taskName.classList.add("checked");
            todos[selectedTask.id].status = "completed";
        } else {
            taskName.classList.remove("checked");
            todos[selectedTask.id].status = "pending";
        }
        localStorage.setItem("todo-list", JSON.stringify(todos))
    }
    
    function editTask(taskId, textName) {
        editId = taskId;
        isEditTask = true;
        taskInput.value = textName;
        taskInput.focus();
        taskInput.classList.add("active");
    }
    
    function deleteTask(deleteId, filter) {
        isEditTask = false;
        todos.splice(deleteId, 1);
        localStorage.setItem("todo-list", JSON.stringify(todos));
        showTodo(filter);
    }
    
    clearAll.addEventListener("click", () => {
        isEditTask = false;
        todos.splice(0, todos.length);
        localStorage.setItem("todo-list", JSON.stringify(todos));
        showTodo()
    });
    
    taskInput.addEventListener("keyup", e => {
        let userTask = taskInput.value.trim();
        if(e.key == "Enter" && userTask) {
            if(!isEditTask) {
                todos = !todos ? [] : todos;
                let taskInfo = {name: userTask, status: "pending"};
                todos.push(taskInfo);
            } else {
                isEditTask = false;
                todos[editId].name = userTask;
            }
            taskInput.value = "";
            localStorage.setItem("todo-list", JSON.stringify(todos));
            showTodo(document.querySelector("span.active").id);
        }
    });
        </script>    
      </body>
    </html>   
        </div>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,96L48,128C96,160,192,224,288,213.3C384,203,480,117,576,117.3C672,117,768,203,864,202.7C960,203,1056,117,1152,117.3C1248,117,1344,203,1392,245.3L1440,288L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
</section>



<!-- /////////////////////////////////////////////////////////////////////////////////////////////////
                                            {{-- SCHEDULE --}}
 ///////////////////////////////////////////////////////////////////////////////////////////-->

<section id="Schedule" class="Schedule">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,96L48,128C96,160,192,224,288,213.3C384,203,480,117,576,117.3C672,117,768,203,864,202.7C960,203,1056,117,1152,117.3C1248,117,1344,203,1392,245.3L1440,288L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
  <div class="container">
    <div class="row text-center text-white">
      <h1 class="display-3 fw-bold">Schedule</h1>
      <hr style="width: 100px; height: 3px; " class="mx-auto">
      <p class="lead pt-1">Lets create your schedule!</p>
      <img src="okiii.png" width="300px" height="900px"> 
      <center> <a href="schedule.php"> <button type="button" class="rounded-pill btn-rounded border-primary">create my schedule
        <span><i class="fas fa-arrow-right"></i></span> 
      </button> </a></center>
      
    </div>

   
        </div>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,96L48,128C96,160,192,224,288,213.3C384,203,480,117,576,117.3C672,117,768,203,864,202.7C960,203,1056,117,1152,117.3C1248,117,1344,203,1392,245.3L1440,288L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
</section>




<!-- /////////////////////////////////////////////////////////////////////////////////////////////////
                                            {{-- NOTES--}}
 ///////////////////////////////////////////////////////////////////////////////////////////-->

<section id="notes" class="notes">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,96L48,128C96,160,192,224,288,213.3C384,203,480,117,576,117.3C672,117,768,203,864,202.7C960,203,1056,117,1152,117.3C1248,117,1344,203,1392,245.3L1440,288L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
  <div class="container">
    <div class="row text-center text-white">
      <h1 class="display-3 fw-bold">Notes</h1>
      <hr style="width: 100px; height: 3px; " class="mx-auto">
      
      <form>
      <div class="col-lg-12 mb-3">
        <br><br><br>
        <textarea name="message" placeholder="Tulis notes anda..." id="message" rows="7" class="shadow form-control form-control-lg"></textarea>
      </div>
      <div class="text-center d-grid mt-1">
        <button type="button" class="btn btn-primary rounded-pill pt-3 pb-3">
          submit
          <i class="fas fa-paper-plane"></i>
        </button>
      </div>
      
    </form>
    </div>

   
        </div>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,96L48,128C96,160,192,224,288,213.3C384,203,480,117,576,117.3C672,117,768,203,864,202.7C960,203,1056,117,1152,117.3C1248,117,1344,203,1392,245.3L1440,288L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
</section>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////
                       START SECTION 6 - THE FAQ 
//////////////////////////////////////////////////////////////////////////////////////////////////////-->
<section id="faq" class="faq">
  <div class="container">
    <div class="row text-center">
      <h1 class="display-3 fw-bold text-uppercase">QnA</h1>
      <div class="heading-line"></div>
      <p class="lead">Qusetion and Answer <br> frequently asked questions, get knowledge befere hand</p>
    </div>
    <!-- ACCORDION CONTENT  -->
    <div class="row mt-5">
      <div class="col-md-12">
        <div class="accordion" id="accordionExample">
          <!-- ACCORDION ITEM 1 -->
          <div class="accordion-item shadow mb-3">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              What is a to-do list web application?
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="accordion-body">
              A to-do list web application is a software program that helps you organize and manage tasks or activities that need to be completed.
              </div>
            </div>
          </div>
             <!-- ACCORDION ITEM 2 -->
          <div class="accordion-item shadow mb-3">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              How does a to-do list web application work?
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                A to-do list web application typically allows users to create tasks, set due dates, prioritize tasks, add notes or descriptions, and mark tasks as completed. The application may also offer features such as reminders, notifications, and the ability to collaborate with others.
              </div>
            </div>
          </div>
             <!-- ACCORDION ITEM 3 -->
          <div class="accordion-item shadow mb-3">
            <h2 class="accordion-header" id="headingThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              What are the benefits of using a to-do list web application?
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                A to-do list web application can help increase productivity, reduce stress and anxiety, and improve time management. By organizing tasks and setting priorities, users can focus on the most important tasks and avoid wasting time on less important ones.
              </div>
            </div>
          </div>
             <!-- ACCORDION ITEM 4 -->
          <div class="accordion-item shadow mb-3">
            <h2 class="accordion-header" id="headingFour">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                Can I access my to-do list web application from different devices?
              </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                Yes, most to-do list web applications are accessible from multiple devices such as computers, smartphones, and tablets. This allows users to access their to-do list from anywhere with an internet connection.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br><br><br><br>
</section>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////
              START SECTION 8 - GET STARTED  
/////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<section id="contact" class="get-started">
  <div class="container">
    <div class="row text-center">
      <h1 class="display-3 fw-bold text-capitalize">Daftar</h1>
      <div class="heading-line"></div>
      <p class="lh-lg">
        Daftar dan mulailah manajamen keseharian bersama Flexlist!
      </p>
    </div>
    
    <!-- START THE CTA CONTENT  -->
    <div class="row text-white" id="daftar">
      <div class="gradient shadow p-3">
        <div class="cta-info w-100">
          <center><h4 class="display-4 fw-bold">Isi Data</h4> </center> 
          <br> <br>       
          <?php
    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $check = mysqli_query($koneksi, "SELECT * FROM akun WHERE username = '$username' OR email = '$email' OR phone = '$phone'");
        $data_daftar = mysqli_fetch_assoc($check);
        if (mysqli_num_rows($check) > 0) {
            echo "<script>Swal.fire('Error!','Akun sudah terdaftar!','error')</sscript>";
        } else {
            $daftar = mysqli_query($koneksi, "INSERT INTO akun (nama,username,email,phone,password) VALUES ('$nama','$username','$email','$phone','$password')");
            if ($daftar == TRUE) {
                $_SESSION['user'] = $data_daftar;
                $data = [
            'api_key' => '0K2HL7ldUGUXGqGxGtV2gl5rkTkhL7',
            'sender'  => '6282269706975',
            'number'  => $phone,
            'message' => 'Halo '.$nama.', terima kasih sudah daftar!'
        ];       
        $curl = curl_init();             
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://dvn.gateaway.my.id/send-message",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => json_encode($data),
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));
    $response = curl_exec($curl);
    curl_close($curl);
                echo "<script>Swal.fire('Success!','Akun berhasil didaftarkan!','success')</sscript>";
            } else {
                echo "<script>Swal.fire('Error!','Error System!','error')</sscript>";
            }
            
        }
    }
  if (isset($_POST['login'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $check = mysqli_query($koneksi, "SELECT * FROM akun WHERE username = '$username'");
      $data = mysqli_fetch_assoc($check);
      if (mysqli_num_rows($check) == 0) {
          echo "<script>Swal.fire('Error!','Akun tidak ditemukan!','error')</sscript>";
      } else if ($password != $data['password']) {
          echo "<script>Swal.fire('Error!','Password salah!','error')</sscript>";
      } else {
            $_SESSION['user'] = $data;
            header("Location: ".$url);
      }
  }
  ?>
          <form method="POST" class="row">
            <div class="col-lg-6 col-md mb-3">
              <input type="text" placeholder="Nama" id="nama" name="nama" class="shadow form-control form-control-lg">
            </div>
            <div class="col-lg-6 col-md mb-3">
              <input type="text" placeholder="Username" id="username" name="username" class="shadow form-control form-control-lg">
            </div>
            <div class="col-lg-6 col-md mb-3">
              <input type="number" placeholder="Phone" id="phone" name="phone" class="shadow form-control form-control-lg">
            </div>
            <div class="col-lg-6 mb-3">
              <input type="email" placeholder="Email" id="email" name="email" class="shadow form-control form-control-lg">
            </div>
            <center> <div class="col-lg-6 col-md mb-3">
              <input type="text" placeholder="Password" id="password" name="password" class="shadow form-control form-control-lg">
            </div> </center>
            <div class="text-center d-grid mt-1">
              <button type="submit" name="submit" class="btn btn-primary rounded-pill pt-3 pb-3">
                daftar
                <i class="fas fa-paper-plane"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="contact" class="get-started">
  <div class="container">

    <!-- START THE CTA CONTENT  -->
     <center><h1 class="display-3 fw-bold text-capitalize">Kritik dan Saran</h1> 
      <p class="lh-lg">
        We receive about new ideas that can help us to improve FlexListðŸ’— 
      </p></center>
      <div class="heading-line"></div>
    <div class="row text-white">
      <div class="gradient shadow p-3">
        <div class="cta-info w-100">
          <br> <br>       
          <form action="#" class="row">
            <div class="col-lg-6 col-md mb-3">
              <input type="text" placeholder="Nama Depan" id="inputFirstName" class="shadow form-control form-control-lg">
            </div>
            <div class="col-lg-6 col-md mb-3">
              <input type="text" placeholder="Nama Belakang" id="inputLastName" class="shadow form-control form-control-lg">
            </div>
            <div class="col-lg-12 mb-3">
              <input type="email" placeholder="Email" id="inputEmail" class="shadow form-control form-control-lg">
            </div>
            <div class="col-lg-12 mb-3">
              <textarea name="message" placeholder="Tulis kritik dan saran anda di sini..." id="message" rows="3" class="shadow form-control form-control-lg"></textarea>
            </div>
            <div class="text-center d-grid mt-1">
              <button type="button" class="btn btn-primary rounded-pill pt-3 pb-3">
                submit
                <i class="fas fa-paper-plane"></i>
              </button>
            </div>
          </form>
        </div>
        <hr>
      </div>
    </div>
    <br><br>
  </div>
  
</section>

<div class="row text-center"> 
 
      <h1 class="display-3 fw-bold text-capitalize">Our Contact</h1>
      <div class="heading-line"></div>
      <p class="lh-lg">
       Also you can connect with us through our contact.
      </p>
    </div>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////
                           START SECTION 9 - THE FOOTER  
///////////////////////////////////////////////////////////////////////////////////////////////-->
<footer class="footer">
  <div class="container">
    <div class="row">
      <!-- CONTENT FOR THE MOBILE NUMBER  -->
      <div class="col-md-4 col-lg-4 contact-box pt-1 d-md-block d-lg-flex d-flex">
        <div class="contact-box__icon">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone-call" viewBox="0 0 24 24" stroke-width="1" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
            <path d="M15 7a2 2 0 0 1 2 2" />
            <path d="M15 3a6 6 0 0 1 6 6" />
          </svg>
        </div>
        <div class="contact-box__info">
          <a href="#" class="contact-box__info--title">081316743514 <br> 081271076622 <br> 082269706975</a>
          <p class="contact-box__info--subtitle">  Mon-Fri 9am-6pm</p>
        </div>
      </div>  
      <!-- CONTENT FOR EMAIL  -->
      <div class="col-md-4 col-lg-4 contact-box pt-1 d-md-block d-lg-flex d-flex">
        <div class="contact-box__icon">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-opened" viewBox="0 0 24 24" stroke-width="1" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <polyline points="3 9 12 15 21 9 12 3 3 9" />
            <path d="M21 9v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10" />
            <line x1="3" y1="19" x2="9" y2="13" />
            <line x1="15" y1="13" x2="21" y2="19" />
          </svg>
        </div>
        <div class="contact-box__info">
          <a href="#" class="contact-box__info--title">flexlist0@gmail.com</a>
          <p class="contact-box__info--subtitle">Our Gmail</p>
        </div>
      </div>
      <!-- CONTENT FOR LOCATION  -->
      <div class="col-md-4 col-lg-4 contact-box pt-1 d-md-block d-lg-flex d-flex">
        <div class="contact-box__icon">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-2" viewBox="0 0 24 24" stroke-width="1" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <line x1="18" y1="6" x2="18" y2="6.01" />
            <path d="M18 13l-3.5 -5a4 4 0 1 1 7 0l-3.5 5" />
            <polyline points="10.5 4.75 9 4 3 7 3 20 9 17 15 20 21 17 21 15" />
            <line x1="9" y1="4" x2="9" y2="17" />
            <line x1="15" y1="15" x2="15" y2="20" />
          </svg>
        </div>
        <div class="contact-box__info">
          <a href="https://telkomuniversity.ac.id/" class="contact-box__info--title">Telkom University</a>
          <p class="contact-box__info--subtitle">Bandung, West Java</p>
        </div>
      </div>
    </div>
  </div>

  <!-- START THE SOCIAL MEDIA CONTENT  -->
  <div class="footer-sm" style="background-color: #212121;">
    <div class="container">
      <div class="row py-4 text-center text-white">
        <div class="col-lg-5 col-md-6 mb-4 mb-md-0">
          connect with us on social media
        </div>
        <div class="col-lg-7 col-md-6">        
          <a href="https://github.com/havascientist/FlexList"><i class="fab fa-github"></i></a>          
          <a href="https://www.instagram.com/flex_list/"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </div>
  </div>

  <!-- START THE COPYRIGHT INFO  -->
  <div class="footer-bottom pt-5 pb-5">
    <div class="container">
      <div class="row text-center text-white">
        <div class="col-12">
          <div class="footer-bottom__copyright">
            &COPY; Enjoy our web in <a href="#" target="_blank">Flexlist</a><br><br>            
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- BACK TO TOP BUTTON  -->


    
<a href="#" class="shadow btn-primary rounded-circle back-to-top">
  <i class="fas fa-chevron-up"></i>
</a>


<div id="id01" class="modal">
  <form class="modal-content animate" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <!--<img src="templet/images/flexlist.png" alt="Avatar" class="avatar">-->
    </div>

    <div class="container">
      <label for="username"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username" required>

      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
        <div class="text-center d-grid mt-1">
      <button class="btn btn-primary rounded-pill pt-3 pb-3" type="submit" name="login">Login</button>
      </div>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
   
    <script src="templet/assets/vendors/js/glightbox.min.js"></script>

    <script type="text/javascript">
      const lightbox = GLightbox({
        'touchNavigation': true,
        'href': 'https://www.youtube.com/watch?v=J9lS14nM1xg',
        'type': 'video',
        'source': 'youtube', //vimeo, youtube or local
        'width': 900,
        'autoPlayVideos': 'true',
});
    </script>
     <script src="templet/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
