<template>
  <section>
    <!-- ++++++++++++++++++++++++++++ Form Update +++++++++++++++++ +++++++++++++++++-->
    <div v-if="isUpdated" class="contianer_update">
      <form @submit.prevent="toUpdate">
    <label for="image" style="color: black">
      <div class="user-profile">
        <img :src="'http://127.0.0.1:8000/storage/pictures/' + image" />
      </div>
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
        id="F"
        value="Female"
        name="gender"
        v-model="gender"
      />
      <label for="F">Female</label>
      <input
        class="radio-input"
        type="radio"
        id="M"
        value="Male"
        name="gender"
        v-model="gender"
      />
      <label for="M">Male</label>
    </div>
    <div class="btn-group">
      <button class="btn btn-submit" type="submit">
        Update
      </button>
    </div>
  </form>
    </div>
    <!--  action on student like search by name, filter by batch, and add new students  -->
    <div class="action" v-if="!isDetail">
      <div style="display: flex">
        <h2 class="students">Students</h2>
        <div class="search">
          <input type="text" placeholder="search" v-model="search" />
        </div>
        <div class="filter">
          <select v-model="batch">
            <option value="" selected disabled>Batch</option>
            <option value="all">All</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
          </select>
        </div>
      </div>
      <div class="btnadd">
        <button class="btn-add" @click="addStudent()">ADD STUDENT</button>
      </div>
    </div>
    <!-- ++++++++++++++++++++ List students ++++++++++++++++ -->

    <div class="tb-container" v-if="!isDetail">
      <table class="table">
        <thead>
          <tr>
            <th>USER</th>
            <th class="padding-right">GENDER</th>
            <th>ACTION</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for:="(student, index) of filteredStudentLists">
            <td>
              <div class="user">
                <div class="img">
                  <img
                    :src="
                      'http://127.0.0.1:8000/storage/pictures/' + student.image
                    "
                    alt=""
                  />
                </div>
                <div class="info">
                  <strong>{{
                    student.firstname + " " + student.lastname
                  }}</strong>
                  <p>{{ student.class }} {{ student.batch }}</p>
                </div>
              </div>
            </td>
            <td class="padding-right">{{ student.gender }}</td>
            <td class="tb-btn">
              <div class="icon">
                <img src="../../assets/view-details.png" alt="" @click="viewStudentDetail(student.id)"/>
                <i
                  class="fa fa-trash fa-2x"
                  @click="removeStudent(index, student.id)"
                ></i>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <student-detail
      v-if="isDetail"
      :student="student"
      :index="index"
      :studentLeaves="studentLeaves"

      @hide-detail="isDetail = !isDetail"
      @studentUpdate="UpdateStudent"
    ></student-detail >
  </section>
</template>

<script>
import http from "../../axios-http";
import swal from "sweetalert";
import StudentDetail from "./StudentDetail.vue";
export default {
  components: { "student-detail": StudentDetail },
  data() {
    return {
      listOfStudents: [],
      indexToUpdate:null,
      firstname: "",
      lastname: "",
      email: "",
      password: "",
      phone:"",
      gender: "",
      classroom: "",
      generation: "",
      image: null,
      update_id: null,
      isUpdated: false,
      search: "",
      batch: "",

      // +++++++++++ student detail data ++++++++++++++++++++
      isDetail: false,
      student: [],
      studentLeaves: [],
    };
  },

  methods: {
    studentFromAPI() {
      http.get("student").then((res) => {
        this.listOfStudents = res.data;
      });
    },
    addStudent() {
      this.$emit("add-student", true);
      this.studentFromAPI();
    },
    removeStudent(index, id) {
      swal({
        title: "Are you sure to delete?",
        text: "This student will be remove from the list of students",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          http.delete("student/" + id).then((res) => {
            console.log(res);
          });
          this.listOfStudents.splice(index, 1);
        }
      });
    },
    UpdateStudent(student) {
      this.isUpdated = true;
      this.isDetail=false;
      this.update_id = student.id;
      this.firstname = student.firstname;
      this.lastname = student.lastname;
      this.email = student.email;
      this.password = student.password;
      this.phone = student.phone;
      this.gender = student.gender;
      this.image = student.image;
      this.classroom = student.class;
      this.generation = student.batch;
    },
    uploadImage(e) {
      console.log("This file image", e.target.files[0]);
      this.image = e.target.files[0];
    },
    toUpdate() {
      let newInfor = {
        firstname: this.firstname,
        lastname: this.lastname,
        email: this.email,
        password: this.password,
        gender: this.gender,
        class: this.classroom,
        batch: this.generation,
        phone: this.phone,
      };
    
      this.updateCurrent(newInfor, this.update_id, this.image)
      this.$emit("updateStudent", {
        update_id: this.update_id,
        infor: newInfor,
      });
      this.isUpdated = false;
    },
    updateCurrent(student, id, img){
      let index=0
      for (let update of this.listOfStudents){
        if(update.id===id){
          student["image"]=img
          student['id']=id
          this.listOfStudents[index]=student
          console.log("Student update is : ", this.listOfStudents[index]);
        }
        index++
      }
      
    },

    viewStudentDetail(student_id) {
      
      this.isDetail = !this.isDetail;
      http.get("student/" + student_id).then((res) => {
        this.student = res.data[0];
      });
    },
  },
  computed: {
    // ++++++++ filter students list by username and batch ++++++++++++++++
    filteredStudentLists() {
      if (this.search != "") {
        let student_list = this.listOfStudents;
        if (this.batch != "" && this.batch != "all") {
          student_list = this.listOfStudents.filter(
            (student) => student.batch == this.batch
          );
        }
        return student_list.filter((student) => {
          let username = student.firstname + student.lastname;
          return username.toLowerCase().includes(this.search.toLowerCase());
        });
      }
      if (this.batch != "" && this.batch != "all") {
        const student_list = this.listOfStudents.filter(
          (student) => student.batch == this.batch
        );
        if (this.search != "") {
          return this.listOfStudents.filter((student) => {
            return student.username
              .toLowerCase()
              .includes(this.search.toLowerCase());
          });
        } else {
          return student_list;
        }
      }

      return this.listOfStudents;
    },
  },
  mounted() {
    this.studentFromAPI();
  },
};
</script>

<style scoped>
.contianer_update {
  position: absolute;
  width: 100%;
  padding: 4rem 0;
  background-color: rgb(252, 249, 249);
}
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
  width: 10rem;
  height: 10rem;
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

.username {
  display: flex;
}
.username {
  display: flex;
}

.inputname {
  display: block;
}

.lastname,
.generation {
  margin-left: 4px;
}

label {
  font-weight: bold;
  color: white;
}

.password {
  border: none;
  padding: 6px;
  outline: none;
}
.fa {
  cursor: pointer;
}

.btn-add {
  color: white;
  padding: 10px;
  font-size: 15px;
  background-color: rgba(34, 187, 234, 1);
  border: none;
  border-radius: 5px;
}

.user {
  display: flex;
}

.info {
  padding: 0 10px;
  margin-top: 8px;
}
.info strong {
  font-weight: 600;
}
.info p {
  font-weight: 500;
  margin-right: 25px;
  font-size: small;
}

img {
  height: 50px;
  width: 50px;
  border-radius: 50%;
}

.icon {
  display: flex;
}
.icon img {
  margin: 0;padding: 0;
  width: 2rem;
  height: 2rem;
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
  margin: 0 5px;
}
.fa-trash {
  color: red;
}
.fa-edit {
  color: rgb(53, 159, 245);
  margin-top: 3px;
}

/* ++++++++++++++++++ table list studetns +++++++++++++++ */
.tb-container {
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  width: 70%;
  margin: auto;
  padding: 10px;
}
table {
  width: 100%;
  margin: auto;
  border-collapse: collapse;
}
tr th,
tr td {
  padding: 10px;
  text-align: left;
}
tbody tr {
  border-top: 8px solid white;
  border-bottom: 8px solid white;
  background: rgb(233, 233, 233);
  border-radius: 40%;
}
thead tr th {
  border: none;
}
tbody tr:hover {
  background: rgb(220, 220, 220);
}
tr td:first-child {
  border-top-left-radius: 10%;
  border-bottom-left-radius: 10%;
}
tr td:last-child {
  border-top-right-radius: 15%;
  border-bottom-right-radius: 15%;
}
.padding-right {
  padding-right: 3rem;
}
.action {
  width: 74%;
  margin: auto;
  display: flex;
  padding: 2rem 0;
  justify-content: space-between;
}
.action div {
  margin: 0 1rem;
}

.search input,
.filter select {
  padding: 7px;
  outline: none;
}
.filter select {
  width: 10rem;
}
.students {
  font-size: 2rem;
}
.tb-btn {
  width: 6rem;
}
</style>