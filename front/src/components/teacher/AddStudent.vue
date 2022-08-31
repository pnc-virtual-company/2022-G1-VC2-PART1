<template>
  <!-- +++++++++++++++++++++ MY CODE ++++++++++++++++ -->
  <form>
    <label for="image" style="color: black">
      <div class="user-profile">
        <img src="../../assets/profile1.png" alt="" />
      </div>
      <input type="file" style="display: none" id="image" @change="uploadImage"/>
    </label>
    <div class="two-input">
      <div class="form-group">
        <div>
          <label for="firstname">First Name</label>
        </div>
        <input
          class="form-control"
          type="text"
          id="firstname"
          v-model="firstname"
        />
      </div>
      <div class="form-group">
        <div>
          <label for="lastname">Last Name</label>
        </div>
        <input
          class="form-control"
          type="text"
          id="lastname"
          v-model="lastname"
        />
      </div>
    </div>
    <div class="form-group">
      <div>
        <label for="email">Email</label>
      </div>
      <input class="form-control" type="text" id="email" v-model="email" />
    </div>
    <div class="form-group">
      <div>
        <label for="phone">Phone</label>
      </div>
      <input class="form-control" type="tel" id="phone" v-model="phone" />
    </div>

    <div class="two-input">
      <div class="form-group">
        <div>
          <label for="class">Classroom</label>
        </div>
        <input
          class="form-control"
          type="text"
          id="class"
          v-model="classroom"
        />
      </div>
      <div class="form-group">
        <div>
          <label for="generation">Generation</label>
        </div>
        <input
          class="form-control"
          type="text"
          id="generation"
          v-model="generation"
        />
      </div>
    </div>
    <div class="form-group radio">
      <span>Gender : </span>
      <input
        class="radio-input"
        type="radio"
        id="M"
        value="M"
        name="gender"
        v-model="gender"
      />
      <label for="M">Male</label>
      <input
        class="radio-input"
        type="radio"
        id="F"
        value="F"
        name="gender"
        v-model="gender"
      />
      <label for="F">Female</label>
    </div>
    <div class="btn-group">
      <button class="btn btn-cancele" type="submit" @click.prevent="canceleAdd">
        Cancele
      </button>
      <button class="btn btn-submit" type="submit" @click.prevent="addUser">
        ADD
      </button>
    </div>
  </form>
</template>
<!-- +++++++++++++++++++++++++++ MY CODE +++++++++++++++++ -->
<script>
// <!-- +++++++++++++++++++++++++++ MY CODE +++++++++++++++++ -->

import axios from "@/axios-http";
import swal from "sweetalert";
export default {
  data() {
    return {
      firstname: "",
      lastname: "",
      email: "",
      password: "12345678",
      gender: "",
      classroom: "",
      generation: "",
      phone: "",
      image: null,
      user_id: null,
    };
  },

  methods: {
    uploadImage(e) {
      this.image = e.target.files[0];
      console.log(this.image);
      console.log(e.target.files);
    },
    addUser() {
      let user = new FormData();
      user.append("firstname", this.firstname);
      user.append("lastname", this.lastname);
      user.append("email", this.email);
      user.append("password", this.password);
      user.append("role", 0);
      user.append("image", this.image);
      axios.post("register", user).then((response) => {
        this.user_id = response.data.id;
        if (this.user_id) {
          this.createStudent();
        }
      });
    },
    createStudent() {
      let student = new FormData();
      student.append("firstname", this.firstname);
      student.append("lastname", this.lastname);
      student.append("email", this.email);
      student.append("password", this.password);
      student.append("image", this.image);
      student.append("phone", this.phone);
      student.append("class", this.classroom);
      student.append("batch", this.generation);
      student.append("gender", this.gender);
      student.append("user_id", this.user_id);
      console.log("student");
      axios
        .post("student", student)
        .then((res) => {
          swal({
            title:
              this.firstname +
              " " +
              this.lastname +
              " is added to the list of students.",
            icon: "success",
            buttons: true,
          }).then((isAdd) => {
            if (isAdd) {
              this.firstname = "";
              this.lastname = "";
              this.email = "";
              this.password = "";
              this.gender = "";
              this.classroom = "";
              this.generation = "";
              this.phone = "";
              this.$emit("add-Student", false);
            }
          });
          return res.data;
        })
        .catch((error) => {
          if (error.response) {
            console.log(error.response);
          }
        });
    },
    canceleAdd() {
      console.log("hh");
      this.$emit("cancele-add", false);
    },
  },
};
// <!-- +++++++++++++++++++++++++++ MY CODE +++++++++++++++++ -->
</script>
<style scoped>
/* // <!-- +++++++++++++++++++++++++++ MY CODE +++++++++++++++++ --> */

form {
  width: 40%;
  margin: auto;
  padding: 10px;
  margin-top: 2rem;
  border-radius: 10px;
  box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px,
    rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
}
.form-group {
  padding: 7px;
  width: 100%;
}
.form-control {
  padding: 7px;
  width: 95%;
  box-sizing: border-box;
  border-radius: 3px;
  outline: none;
  border: 1px solid gray;
  background: rgb(251, 251, 251);
}
.two-input {
  display: flex;
}
.btn-group {
  display: flex;
  justify-content: flex-end;
  padding-right: 20px;
}
.btn {
  background: orange;
  border: none;
  padding: 10px;
  width: 25%;
  border-radius: 3px;
  margin-top: 1rem;
  color: #fff;
}
.btn-cancele {
  background: none;
  color: rgb(70, 70, 70);
  border: 1px solid gray;
  margin-right: 1rem;
}

.fa {
  cursor: pointer;
}
.user-profile {
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 1rem 0;
}
.user-profile img {
  width: 5rem;
  height: 5rem;
}
label,
span {
  font-weight: 550;
  color: rgb(60, 59, 59);
}
.radio label {
  margin-right: 1rem;
  font-weight: lighter;
  color: black;
}

.radio-input {
  margin-right: 5px;
}
/* // <!-- +++++++++++++++++++++++++++ MY CODE +++++++++++++++++ --> */
</style>