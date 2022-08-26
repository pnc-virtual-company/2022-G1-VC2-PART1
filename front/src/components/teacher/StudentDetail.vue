<template>
  <section>
    <div class="student-detail">
      <div class="header header-detail">
        <h3>Personal Information</h3>
        <img
          src="../../assets/cross.png"
          alt=""
          @click="this.$emit('hide-detail')"
        />
      </div>

      <div class="personal-info">
        <div class="header header-info">
          <h3>Personal Information</h3>
        </div>
        <div class="main-content">
          <div class="profile-container">
            <div class="profile">
              <img
                :src="'http://127.0.0.1:8000/storage/pictures/' + student.image"
              />
            </div>
            <h1 class="username">
              {{ student.firstname }} {{ student.lastname }}
            </h1>
            <i
              class="fa fa-edit fa-2x"
              style="color: #03a9f4"
              @click="editStudent(student)"
            ></i>
          </div>
          <div class="user-info">
            <div class="two-info">
              <div class="user-group">
                <p>First name</p>
                <div class="user-control">
                  <p>{{ student.firstname }}</p>
                </div>
              </div>
              <div class="user-group">
                <p>Last name</p>
                <div class="user-control">
                  <p>{{ student.lastname }}</p>
                </div>
              </div>
            </div>
            <div class="two-info">
              <div class="user-group">
                <p>Class</p>
                <div class="user-control">
                  <p>{{ student.class }}</p>
                </div>
              </div>
              <div class="user-group">
                <p>Batch</p>
                <div class="user-control">
                  <p>{{ student.batch }}</p>
                </div>
              </div>
            </div>
            <div class="user-group">
              <p>Gender</p>
              <div class="user-control">
                <p v-if="student.gender == 'M'">{{ student.gender }}ale</p>
                <p v-if="student.gender == 'F'">{{ student.gender }}emale</p>
              </div>
            </div>

            <div class="user-group">
              <p>Phone</p>
              <div class="user-control">
                <p>{{ student.phone }}</p>
              </div>
            </div>
            <div class="user-group">
              <p>Email</p>
              <div class="user-control">
                <p>{{ student.email }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="header header-info">
          <h3>Student Leave Request</h3>
        </div>
        <table>
          <thead>
            <tr>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Reason</th>
              <th>Duration</th>
              <th>Leave Type</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for:="student in studentLeaves">
              <th>{{ student.start_date }}</th>
              <th>{{ student.end_date }}</th>
              <th>{{ student.reason }}</th>
              <th>{{ student.duration }}</th>
              <th>{{ student.leave_type }}</th>
              <th :class="student.status.toLowerCase()">
                {{ student.status }}
              </th>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: ["student", "studentLeaves"],
  data() {
    return {
      firstname: "",
      lastname: "",
      email: "",
      password: "",
      phone: "",
      class: "",
      batch: "",
      role: "",
      gender: "",
      image: null,
    };
  },

  methods: {
    editStudent(student) {
      this.$emit("studentUpdate", student);
    },
  },
};
</script>

<style>
.personal-info,
.header,
.profile-container,
.user-info,
.user-control,
.container,
.student-detail {
  box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px,
    rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
}
.student-detail {
  width: 58%;
  margin: 6rem 20.2%;
  position: absolute;
  background: white;
  top: 0;
}

.header-detail img {
  width: 2.5rem;
  height: 2.5rem;
  margin: auto 1rem;
}
.header-detail {
  background-color: none;
}
.personal-info {
  margin-bottom: 2.5rem;
  border-radius: 5px;
  margin: 1rem;
}
.header {
  display: flex;
  justify-content: space-between;
  width: 100%;
  height: auto;
  border-radius: 5px 5px 0 0;
}
.header-info {
  background: #23bbea;
}
.header h3 {
  color: #fff;
  padding: 1rem;
}
.header-detail h3 {
  color: #000;
}
.main-content {
  display: flex;
}
.main-content {
  width: 100%;
  height: 100%;
}
.profile-container {
  padding: 1rem;
  width: 20%;
  height: 35vh;
  border-radius: 5px;
  margin: 1rem;
}

.profile img {
  width: 10rem;
  height: 10rem;
  border-radius: 50%;
  margin: 2px auto;
}
.username {
  text-align: center;
  margin-top: 1rem;
  font-size: 20px;
}
.user-info {
  width: 63.5%;
  height: 100%;
  margin: 1rem;
  padding: 1rem;
  border-radius: 5px;

  margin: 1rem;
}
.two-info {
  display: flex;
}
.user-group {
  width: 100%;
  padding: 10px;
  box-sizing: border-box;
}
.user-control {
  padding: 5px;
  border-radius: 2px;
  margin-top: 5px;
}

/* ++++++++++++++++++++ list  student leave request +++++++++++++++++ */
.container {
  width: 96%;
  margin: auto;
  margin-bottom: 2rem;
  border-radius: 5px;
  margin: 1rem;
}

table {
  padding: 10px;
  width: 100%;
  border-collapse: collapse;
  margin-top: 2vh;
  box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
  font-size: 13px;
}

tr,
th,
td {
  padding: 10px;
  font-weight: 100;
  font-size: 15px;
}

thead tr th {
  color: #178aad;
  border-bottom: 2px solid #23bbea;

  padding: 15px;
  font-size: 15px;
  font-weight: 600;
}
tbody tr:hover {
  background-color: rgba(100, 100, 111, 0.2);
}
.padding {
  color: #ffba07;
}
.approved {
  color: #3e9e10;
}
.rejected {
  color: #fe0000;
}
</style>