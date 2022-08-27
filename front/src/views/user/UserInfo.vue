<template>
  <div class="userInfo">
    <div class="profile">
      <div class="imgBx">
        <img src="@/assets/lolo.jpg" />
      </div>
      <div class="container">
        <div class="data">
          <h3>Name: SamoulVann</h3>
          <h3>Email: Samoul.vann@student.passerellesnumeriques.org.com</h3>
          <h3>Password: Samoul@#$</h3>
          <h3>Class: Web 2022</h3>
          <h3>Generation: 2022</h3>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
.userInfo {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
}
.profile {
  position: relative;
  width: 350px;
  height: 160px;
  background: #e1e7ea;
  border-radius: 20px;
  box-shadow: 0 35px 80px rgba(0, 0, 0, 0.15);
  transition: 0.5s;
}
.profile:hover {
  height: 430px;
}
.imgBx {
  position: absolute;
  left: 50%;
  top: -50px;
  transform: translateX(-50%);
  width: 150px;
  height: 150px;
  background: #fff;
  border-radius: 20px;
  box-shadow: 0 15px 50px rgba(0, 0, 0, 0.35);
  overflow: hidden;
  transition: 0.5s;
}
.profile:hover .imgBx {
  width: 230px;
  height: 230px;
}
.imgBx img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.profile .container {
  position: absolute;
  width: 100%;
  height: 85%;
  display: flex;
  justify-content: center;
  align-items: flex-end;
  overflow: hidden;
}
.profile .container .data {
  padding: 40px;
  text-align: center;
  width: 100%;
  transition: 0.5s;
  transform: translateY(150px);
}
.profile:hover .container .data {
  transform: translateY(0px);
}
.data {
  color: rgb(5, 5, 5);
}
</style>
