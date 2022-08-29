<template>
  <section>
    <div v-if="clickEdit" class="mainDiv">
      <div class="cardStyle">
        <form id="signupForm">
          <div class="card_profile">
            <!-- <img
              :src="'http://127.0.0.1:8000/storage/pictures/' + user.image"
              class="img-profile"
            /> -->
          </div>
          <h2 class="formTitle">Change your password</h2>
          <div class="inputDiv">
            <label class="inputLabel" for="password">New Password</label>
            <div class="password_controller">
              <input
                :type="isPasswordShown ? 'text' : 'password'"
                v-model="password"
                name="password"
                required
                autocomplete="on"
              />
              <i
                @click="showHidePassword"
                :class="isPasswordShown ? 'fa fa-eye' : 'fa fa-eye-slash'"
                style="font-size: 20px"
              ></i>
            </div>
          </div>
          <div class="inputDiv">
            <label class="inputLabel" for="password">Confirm Password</label>
            <div class="password_controller">
              <input
                :type="isPasswordConfirmed ? 'text' : 'password'"
                v-model="confirmPassword"
                name="password"
                required
                autocomplete="on"
              />
              <i
                @click="showHidePasswordConfirm"
                :class="isPasswordConfirmed ? 'fa fa-eye' : 'fa fa-eye-slash'"
                style="font-size: 20px"
              ></i>
            </div>
          </div>
          <small style="margin-left: 5rem; color: orangered">{{
            invalidPassword
          }}</small>
          <div class="buttonWrapper">
            <button
              type="submit"
              id="submitButton"
              class="submitButton pure-button pure-button-primary"
              @click.prevent="validatePassword(user.id)"
            >
              <span>Change</span>
            </button>
            <p>No, don't want to update</p>
            <strong id="back" @click="clickEdit = false">Go back</strong>
          </div>
        </form>
      </div>
    </div>
    <div v-if="!clickEdit && !clickChangeprofile" class="contianer">
      <div class="card" v-if="user!=null">
        <div class="card_profile">
          <img
            :src="'http://127.0.0.1:8000/storage/pictures/' + user.image"
            alt=""
            class="img-profile"
          />
          <i
            class="fa fa-camera"
            style="font-size: 24px"
            @click="showHideCardPf"
          ></i>
        </div>
        <h1 style="text-align: center; margin: 1rem">
          {{ user.firstname }} {{ user.lastname }}
        </h1>
        <hr />
       
          <ul>
            <li>
              <span class="bold-text">Email : </span>
              <span>{{user.email}}</span>
            </li>
          </ul>
       
        <button @click="clickEdit = true" class="btn-edit">
          Change Password
        </button>
      </div>
      
    </div>

    <!-- update profile -->
    <div class="update-pf" v-if="clickChangeprofile">
      <h2 class="title">Update your profile</h2>
      <div class="card_pf">
        <img
          :src="'http://127.0.0.1:8000/storage/pictures/' + user.image"
          class="img-pf"
        />
      </div>
      <div class="card-change">
        <input @change="saveUpload" id="profile-upload" type="file" hidden>
        <label for="profile-upload" class="change" @click="showUpload">
          <i class="fa fa-edit" style="font-size: 36px; color: #3cabce"></i>
          <p>Change</p>
        </label>

        <div class="trash">
          <i class="fa fa-trash" style="font-size: 36px; color: #ff0d0d"></i>
          <p>remove</p>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import axios from "@/axios-http";
// import swal from "sweetalert";

export default {
  data() {
    return {
      clickChangeprofile: false,
      confirmPassword: "",
      password: "",
      clickEdit: false,
      isPasswordShown: false,
      isPasswordConfirmed: false,
      invalidPassword: "",
      currentuser_id: null,
      isUpload: false,
      image: null,
      user:null,
    };
  },
  methods: {

    saveUpload(event){
      console.log(this.user.id);
        this.image = event.target.files[0];
        let formData = new FormData();
        formData.append('profile_image', this.image);
        formData.append('_method', 'PUT');

        axios.post("/student/reset_profile/" + 1, formData).then(res => {
          console.log(res);
        })

    },
    validatePassword(id) {
      if (this.password != "") {
        if (this.confirmPassword != "") {
          if (this.confirmPassword == this.password) {
            axios
              .put("/userlogin/password/update/" + id, this.password)
              .then((res) => {
                // swal("Good job!", "Your password is changed!", "success").then(
                //   (isChange) => {
                //     if (isChange) {
                //       this.clickEdit = false;
                //     }
                //   }
                // );
                this.password = "";
                this.confirmPassword = "";
                this.invalidPassword = "";
                return res.data;
              })
              .catch((error) => {
                if (error.response) {
                  console.log(error.response);
                  this.invalidPassword =
                    "* Invalid password and confirm password !";
                }
              });
          } else {
            this.invalidPassword = "* Invalid confirm password !";
          }
        } else {
          this.invalidPassword = "* Please enter your confirm password !";
        }
      } else {
        this.invalidPassword = "* Please enter your new password !";
      }
    },
    showHidePassword() {
      this.isPasswordShown = !this.isPasswordShown;
    },
    showHidePasswordConfirm() {
      this.isPasswordConfirmed = !this.isPasswordConfirmed;
    },

    showHideCardPf() {
      this.clickChangeprofile = !this.clickChangeprofile;
    },
    showUpload() {
      this.isUpload = !this.isUpload;
    },
    userlogin() {
      
        axios.get("userlogin").then((res)=>{
          this.user = res.data;
          console.log("user is ", this.user);
      })
    }
   
  },

  mounted(){
    this.userlogin();
  }

};
</script>

<style scoped>
.contianer {
  width: 50%;
  margin: 2rem auto;
}
.card {
  width: 60%;
  margin: auto;
  padding: 2rem;
  border-radius: 10px;
  box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px,
    rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
}
.card_body {
  text-align: center;
  margin-top: 1rem;
}
ul li {
  list-style: none;
  padding: 10px 0;
  display: flex;
}
.card_profile {
  border-radius: 50%;
  padding: 5px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.img-profile {
  margin: auto;
  box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px,
    rgba(6, 24, 44, 0.65) 0px 4px 6px -1px,
    rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
  width: 6rem;
  height: 6rem;
  border-radius: 100%;
}

.fa-camera {
  position: absolute;
  margin-top: 4rem;
  margin-right: 5px;
  color: #cccccc;
}

.student-name {
  font-weight: bolder;
}
.bold-text {
  text-align: start;
  font-weight: bolder;
  width: 6rem;
}
.btn-edit {
  width: 100%;
  padding: 10px 20px;
  background-color: #065492;
  border-color: #065492;
  color: white;
  border-radius: 5px;
  margin-top: 1rem;
}
.mainDiv {
  display: flex;
  min-height: 100%;
  align-items: center;
  justify-content: center;
  background-color: #f9f9f9;
  font-family: "Open Sans", sans-serif;
}
.cardStyle {
  width: 500px;
  border-color: white;
  background: #fff;
  padding: 1rem 0;
  border-radius: 4px;
  margin: 30px 0;
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
}
#signupLogo {
  max-height: 100px;
  margin: auto;
  display: flex;
  flex-direction: column;
}
.formTitle {
  font-weight: 600;
  margin-top: 20px;
  color: #2f2d3b;
  text-align: center;
}
.inputLabel {
  font-size: 12px;
  color: #555;
  margin-bottom: 6px;
  margin-top: 24px;
}
.inputDiv {
  width: 70%;
  display: flex;
  flex-direction: column;
  margin: auto;
}
input {
  height: 40px;
  width: 100%;
  font-size: 16px;
  border: none;
  padding: 0 11px;
  outline: none;
}
input:disabled {
  cursor: not-allowed;
  border: solid 1px #eee;
}
.buttonWrapper {
  margin-top: 1rem;
}
.submitButton {
  width: 70%;
  height: 40px;
  margin: auto;
  display: block;
  color: #fff;
  background-color: #065492;
  border-color: #065492;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.12);
  box-shadow: 0 2px 0 rgba(0, 0, 0, 0.035);
  border-radius: 4px;
  font-size: 14px;
  cursor: pointer;
}
.submitButton:disabled,
button[disabled] {
  border: 1px solid #cccccc;
  background-color: #cccccc;
  color: #666666;
}

.password_controller {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 4px;
  border-radius: 4px;
  border: solid 1px #ccc;
}
.fa {
  cursor: pointer;
}
.buttonWrapper p {
  text-align: center;
  margin: 1rem 0 5px 0;
}
#back {
  display: flex;
  justify-content: center;
  color: #065492;
  font-weight: bold;
  cursor: pointer;
}

.update-pf {
  width: 40%;
  border: 1px solid black;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px,
    rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
  border: none;
  margin: auto;
}

.title {
  text-align: center;
  font-size: 30px;
}

.card-pf {
  border-radius: 80%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.img-pf {
  display: flex;
  margin: 20px auto;
  box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px,
    rgba(6, 24, 44, 0.65) 0px 4px 6px -1px,
    rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
  width: 20rem;
  height: 20rem;
  border-radius: 100%;
}

.card-change {
  display: flex;
  justify-content: space-evenly;
  padding: 10px;
}

.card-change p {
  margin: 0 20px;
  font-size: 20px;
}

.change,
.trash {
  display: flex;
  align-items: center;
  border: none;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px,
    rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
  display: flex;
  padding: 10px 10px;
  cursor: pointer;
  border-radius: 5px;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
