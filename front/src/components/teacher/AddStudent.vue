<template>
  <form @submit.prevent="addStudent">
    <label for="image" style="color: black">
      <div class="user-profile">
        <img src="../../assets/profile1.png" alt="" />
      </div>
      <input
        type="file"
        style="display: none"
        id="image"
        @change="uploadImage"
      />
    </label>
    <div class="two-input">

      <div class="form-group">
        <div>
          <label for="firstname">First Name</label>
        </div>
        <input class="form-control" type="text" id="firstname" v-model="firstname" />
      </div>
      <div class="form-group">
        <div>
          <label for="lastname">Last Name</label>
        </div>
        <input class="form-control" type="text" id="lastname" v-model="lastname" />
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
      <input class="form-control" type="text" id="phone" v-model="phone" />
    </div>
    <div class="two-input">
      <div class="form-group">
        <div>
          <label for="class">Classroom</label>
        </div>
        <input class="form-control" type="text" id="class" v-model="classroom" />
      </div>
      <div class="form-group">
        <div >
          <label for="generation" >Generation</label>
        </div>
        <input class="form-control" type="text" id="generation" v-model="generation" />
      </div>
    </div>
    <div class="form-group radio">
      <span>Gender : </span>
      <input class="radio-input" type="radio" id="M" value="Male" name="gender" v-model="gender" />
      <label for="M">Female</label>
      <input class="radio-input" type="radio" id="F" value="Female" name="gender" v-model="gender" />
      <label for="F">Male</label>
    </div>

    <div class="form-group">
      <button class="btn btn-submit" type="submit">ADD</button>
    </div>
  </form>
</template>
<script>
import http from "../../axios-http";
export default {
  data() {
    return {
      isPasswordShown: false,
      firstname: "",
      lastname: "",
      email: "",
      password: "12345678",
      gender: "",
      classroom: "",
      generation: "",
      image: null,
    };
  },
  methods: {
    uploadImage(e) {
      this.image = e.target.files[0];
    },
    addStudent() {
      let username = this.firstname + " " + this.lastname;
      let student = new FormData();
      student.append("username", username);
      student.append("email", this.email);
      student.append("password", this.password);
      student.append("gender", this.gender);
      student.append("class", this.classroom);
      student.append("batch", this.generation);
      student.append("image", this.image);
      http.post("student", student).then((res) => {
        this.firstname = "";
        this.lastname = "";
        this.email = "";
        this.password = "";
        this.gender = "";
        this.classroom = "";
        this.generation = "";
        return res.data;
      });
      this.$emit("add-Student", false);
    },
  },
};
</script>
<style scoped>
form {
  width: 40%;
  margin: auto;
  padding: 10px;
  margin-top: 20px;
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

.btn {
  background: orange;
  border: none;
  padding: 10px;
  width: 95%;
  border-radius: 3px;
  margin-top: 1rem;
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
label,span {
  font-weight: 550;
  color: rgb(60, 59, 59);
}
.radio label{
 margin-right: 1rem;
 font-weight: lighter;
 color: black;
}

.radio-input {
  margin-right: 5px;
}

</style>