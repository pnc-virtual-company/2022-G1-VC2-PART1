<template>
  <form>
      <label for="image" style="color: black">
        <div class="user-profile">
          <img v-if="profile != null" :src="profile" alt="" />
          <img v-else src="@/assets/profile1.png" alt="" />
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
<script>
import axios from "@/axios-http";
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
      profile: null,
    };
  },

  methods: {
    uploadImage(e) {
      this.image = e.target.files[0];
      console.log(e.target.files);
      this.profile = URL.createObjectURL(e.target.files[0]);
    },
    addUser() {
      let user = new FormData();
      user.append("firstname", this.firstname);
      user.append("lastname", this.lastname);
      user.append("email", this.email);
      user.append("password", this.password);
      user.append("role", 1);
      user.append("image", this.image);
      axios.post("register", user).then((response) => {
        this.$emit("add-teacher", false);
        return response;
      });
    },

    canceleAdd() {
      this.$emit("cancele-add", false);
    },
  },
};
</script>
<style scoped>
form {
  width: 30rem;
  margin:2rem auto;
  padding: 10px;
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