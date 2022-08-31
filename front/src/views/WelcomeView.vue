<template>
  <div class="welcome">
    <div class="card">
      <div class="contaner">
        <h1>WELCOME TO SLMS!</h1>
        <p>
          Hello guys this for our App that easy for the studends to use in
          <br />
          the school I hope all of you enjoyed with this Application.
        </p>
      </div>
      <img src="../assets/pic.png" alt="" />
    </div>
  </div>
</template>
<style scoped>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body {
    display: flex;
    justify-content: center;
}
.contaner {
    min-width: 400px; 
    padding: 15px;
    line-height: -1rem;

}
.contaner h1 {
    font-size: 2.7rem;
    color: #FF9620;
    animation: type 3s steps(19);
    overflow: hidden;
    white-space: nowrap;
    border-right: 2px solid #FF9620;
    width: 19ch;
}
@keyframes type {
    0% {
        width: 0ch;
    }
    100% {
        width: 19ch;
    }
}

.contaner p {
    color: rgba(51, 51, 51, 0.703);
    line-height: 32px;
    animation: typeping 3s steps(29);
    overflow: hidden;
    white-space: nowrap;
    width: 57ch;

}
@keyframes typeping {
    0% {
        width: 0ch;
    }
    100% {
        width: 57ch;
    }
}

img {
    width: 600px;
}

.card {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-evenly;
}
</style>
    <div class="welcome">
        Wellcome
    </div>
