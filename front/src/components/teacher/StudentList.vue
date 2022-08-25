<template>
  <section>
    <!-- ++++++++++++++++++++++++++++ Form Update +++++++++++++++++ +++++++++++++++++-->
    <div v-if="isUpdated" class="contianer_update">
      <form @submit.prevent="toUpdate">
        <div class="username group">
          <div class="inputname">
            <label for="">First Name:</label>
            <input class="firstname" type="text" v-model="firstname" />
          </div>
          <div class="inputname">
            <label for="" class="lastName">Last Name:</label>
            <input class="lastname" type="text" v-model="lastname" />
          </div>
        </div>
        <div class="email group">
          <label for="">Email:</label>
          <input class="form-group" type="text" v-model="email" />
        </div>
        <div class="password_group group">
          <label for="">Password:</label>
          <div class="password_controller">
            <input
              class="form-group password"
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
        <div class="gender group">
          <label for="">Gender:</label>
          <input class="form-group" type="text" v-model="gender" />
        </div>
        <div class="username">
          <div class="inputname">
            <label for="">Class:</label>
            <input class="classroom" type="text" v-model="classroom" />
          </div>
          <div class="inputname">
            <label for="" class="lastName">Generation:</label>
            <input class="generation" type="text" v-model="generation" />
          </div>
        </div>
        <div id="choose-img">
          <input type="file" id="up" @change="uploadImage" />
        </div>
        <div class="username group">
          <div class="inputname">
            <label for="">Class:</label>
            <input class="classroom" type="text" v-model="classroom" />
          </div>
          <div class="inputname">
            <label for="" class="lastName">Generation:</label>
            <input class="generation" type="text" v-model="generation" />
          </div>
        </div>
        <div id="choose-img group">
          <input type="file" id="up" @change="uploadImage" />
        </div>
        <button class="form-group btn" type="submit">Update</button>
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
                <!-- <i class="fa fa-edit fa-2x" @click="UpdateStudent(student)"></i> -->
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
      :studentLeaves="studentLeaves"

      @hide-detail="isDetail = !isDetail"
    ></student-detail>
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

      firstname: "",
      lastname: "",
      email: "",
      password: "",
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
      this.update_id = student.id;
      this.firstname = student.username;
      this.lastname = student.username;
      this.email = student.email;
      this.password = student.password;
      this.gender = student.gender;
      this.classroom = student.class;
      this.generation = student.batch;
    },
    uploadImage(e) {
      console.log("This file image", e.target.files[0]);
      this.image = e.target.files[0];
    },
    toUpdate() {
      let newInfor = {
        username: this.firstname + " " + this.lastname,
        email: this.email,
        password: this.password,
        gender: this.gender,
        class: this.classroom,
        batch: this.generation,
        image: this.image,
      };
      this.$emit("updateStudent", {
        update_id: this.update_id,
        infor: newInfor,
      });
      this.isUpdated = false;
    },
    viewStudentDetail(student_id) {
      this.isDetail = !this.isDetail;
      http.get("student/" + student_id).then((res) => {
        this.student = res.data[0];
      });
      http.get("/student/leaveRequest/9").then((result) => {
        this.studentLeaves = result.data;
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
  background-color: rgb(184, 182, 182);
}
form {
  width: 40%;
  padding: 20px;
  margin: auto;
  margin-top: 20px;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.26);
  background: #144e5a;
}
.group {
  margin: 10px 0;
}

.form-group {
  width: 100%;
  padding: 10px;
  border: solid 1px rgb(124, 117, 117);
  border-radius: 5px;
  box-sizing: border-box;
  outline: none;
}

.firstname,
.lastname,
.classroom,
.generation {
  width: 100%;
  padding: 10px;
  margin-bottom: 16px;
  border: solid 1px rgb(124, 117, 117);
  border-radius: 5px;
  box-sizing: border-box;
  outline: none;
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