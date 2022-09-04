<template>
  <form>
    <h2>REQUEST LEAVE</h2>
    <div class="form-group">
      <p>Leave Type :</p>
      <select class="form-controll" v-model="leaveType">
        <option value="" selected disabled>Choose your leave type</option>
        <option value="family event">Family Event</option>
        <option value="check health">Check Health</option>
        <option value="sick">Sick</option>
        <option value="ceremony event">Ceremony Event</option>
        <option value="brother/sister married">brother/sister married</option>
      </select>
    </div>
    <p class="error">{{ leaveType_error }}</p>
    <div class="form-group">
      <p>Start Date :</p>
      <div class="" style="display: flex; justify-content: space-between">
        <input
          required
          type="date"
          class="two-input"
          v-model="startDate"
          :min="getCurrentDate"
        />

        <select class="two-input" v-model="startTime">
          <option value="Morning">Morning</option>
          <option value="Afternoon">Afternoon</option>
        </select>
      </div>
      <p class="error">{{ startDate_error }}</p>
      <p class="invalid">{{ invalidStartDate }}</p>
    </div>
    <div class="form-group">
      <p>End Date :</p>
      <div class="" style="display: flex; justify-content: space-between">
        <input
          required
          type="date"
          class="two-input"
          v-model="endDate"
          :min="getCurrentDate"
        />
        <select class="two-input" v-model="endTime">
          <option value="Morning">Morning</option>
          <option value="Afternoon">Afternoon</option>
        </select>
      </div>
      <p class="error">{{ endDate_error }}</p>
      <p class="invalid">{{ invalidEndDate }}</p>
    </div>
    <div class="form-group">
      <p>
        Duration : <span v-if="duration == 0">0 Days</span
        ><span v-else-if="duration <= 3">{{ duration }} Days</span>
        <span v-else style="color: red">Can't not allow</span>
      </p>
    </div>
    <div class="form-group">
      <p>Cause(Reason) :</p>
      <textarea cols="63" rows="5" v-model="cause" class="textarea"></textarea>
    </div>
    <p class="error">{{ reason_error }}</p>

    <div class="form-group">
      <div class="btn-group">
        <button
          class="two-input cancele"
          type="submit"
          @click.prevent="canceleRequest($e)"
        >
          Cancel
        </button>
        <button
          class="two-input submit"
          type="submit"
          @click.prevent="addRequestLeave($e)"
          :disabled="startDate > endDate || duration > 3"
        >
          Submit
        </button>
      </div>
    </div>
  </form>
</template>
<script>
import axios from "@/axios-http";
import moment from "moment";
import swal from "sweetalert";
export default {
  emits: ["addRequestLeave"],
  data() {
    return {
      leaveType: "",
      startDate: "",
      endDate: "",
      startTime: "",
      endTime: "",
      cause: "",
      leaveType_error: "",
      startDate_error: "",
      endDate_error: "",
      startTime_error: "",
      endTime_error: "",
      reason_error: "",
      isValidRequest: false,
      student_id: null,
    };
  },

  methods: {
    canceleRequest() {
      this.leaveType = "";
      this.startDate = "";
      this.endDate = "";
      this.cause = "";
      this.startTime = "";
      this.endTime = "";

      this.$router.push("/welcome");
    },
    getRequestLeave() {
      axios.get("/student_leave_request").then(() => {
        console.log("You get student leave request");
      });
    },

    validationRequest() {
      this.leaveType_error = "";
      this.startDate_error = "";
      this.endDate_error = "";
      this.startTime_error = "";
      this.endTime_error = "";
      this.reason_error = "";
      if (this.leaveType == "") {
        this.leaveType_error = "Please select a type of leave request.";
      } else if (this.startDate == "") {
        this.startDate_error = "Please select a start date.";
      } else if (this.endDate == "") {
        console.error("Please select a end date.");
        this.endDate_error = "Please select a end date.";
      } else if (this.startTime == "") {
        this.startTime_error = "Please select a start time.";
      } else if (this.endTime == "") {
        this.endDate_error = "Please select a end time.";
      } else if (this.cause == "") {
        this.reason_error = "Please write some reason.";
      }
    },

    addRequestLeave() {
      this.validationRequest();
      if (
        this.leaveType_error == "" &&
        this.startDate_error == "" &&
        this.endDate_error == "" &&
        this.startTime_error == "" &&
        this.endTime_error == "" &&
        this.reason_error == ""
      ) {
        this.isValidRequest = true;
      }
      console.log(this.isValidRequest);
      if (this.isValidRequest) {
        let requestleave = {
          leave_type: this.leaveType,
          start_date: this.startDate,
          end_date: this.endDate,
          duration: this.duration,
          reason: this.cause,
          student_id: this.student_id,
        };

        axios.post("/student_leave_request", requestleave).then((res) => {
          swal({
            title: "Okay!",
            text: "Your leave request has been sent !",
            icon: "success",
          }).then((isOkay) => {
            if (isOkay) {
              this.$router.push("/studentListAllLeave");
            }
          });
          this.leaveType = "";
          this.startDate = "";
          this.endDate = "";
          this.cause = "";
          this.startTime = "";
          this.endTime = "";
          return res;
        });
      }
    },

    userlogin() {
      axios.get("userlogin").then((res) => {
        this.getStudentByUserId(res.data.id);
      });
    },

    getStudentByUserId(id) {
      axios.get("student_through_user_id/" + id).then((res) => {
        this.student_id = res.data[0].id;
      });
    },
  },

  computed: {
    getCurrentDate() {
      var date = new Date();
      var tday = date.getDate();
      var month = date.getMonth() + 1;
      var year = date.getUTCFullYear();
      if (tday < 10) {
        tday = "0" + tday;
      }
      if (month < 10) {
        month = "0" + month;
      }
      return year + "-" + month + "-" + tday;
    },
    invalidStartDate() {
      var current_date = new Date().toJSON().slice(0, 10).replace(/-/g, "-");
      if (this.startDate != "" && this.startDate < current_date) {
        return "*Invalid Start date !";
      }
      return "";
    },
    invalidEndDate() {
      if (
        this.startDate != "" &&
        this.endDate != "" &&
        this.startDate > this.endDate
      ) {
        return "*Invalid End date !";
      }
      return "";
    },

    /**
     * Duration is use for calulate duration that student ask permission
     * @paramater dateTime is use for calulate end and start date
     */
    duration() {
      let notEmpty = this.startDate != "" && this.endDate != "";
      let isStart =
        this.startDate == this.endDate &&
        this.startDate != "" &&
        this.endDate != "";
      let halfDay = this.startTime == this.endTime;
      let halfTime = this.startTime != "" && this.endTime != "";

      let dateforLeave = moment(this.startDate, "YYYY.MM.DD HH:mm").diff(
        moment(this.endDate, "YYYY.MM.DD HH:mm")
      );
      let dateTime = 0;

      if (dateforLeave < 0 || dateforLeave == 0) {
        if (notEmpty && halfTime) {
          dateTime = Math.abs(
            moment(this.startDate, "YYYY.MM.DD HH:mm").diff(
              moment(this.endDate, "YYYY.MM.DD HH:mm"),
              "days"
            )
          );
        }
        if (isStart && halfDay && halfTime) {
          dateTime += 0.5;
        } else if (halfDay && notEmpty && halfTime) {
          dateTime += 0.5;
        } else if (!halfDay && halfTime) {
          dateTime += 1;
        }
      }

      return dateTime;
    },
  },

  mounted() {
    this.getRequestLeave(), this.userlogin();
  },
};
</script>

<style scoped>
form {
  width: 100%;
  margin: 2rem auto;
  padding: 10px;
  box-shadow: rgb(177, 176, 176) 0px 5px 15px;
  border-radius: 15px;
}
h2 {
  text-align: center;
  color: #23bbea;
  margin: 1rem;
}
.form-group {
  margin: 10px;
}
.form-controll {
  box-sizing: border-box;
  padding: 13px;
  font-size: 15px;
  width: 100%;
  border-radius: 5px;
  border: 1.5px solid rgb(177, 176, 176);
  outline: none;
}

.textarea {
  outline: none;
  border-radius: 5px;
  resize: none;
  border: 1.5px solid rgb(177, 176, 176);
}
p {
  font-weight: 400;
  margin-bottom: 10px;
  outline: none;
}
.two-input {
  padding: 7px;
  border-radius: 5px;
  width: 46%;
  outline: none;
  border: 1.5px solid rgb(177, 176, 176);
}
span {
  color: #ff9620;
  font-weight: bold;
}

button {
  border: none;
  font-weight: bold;
}
.btn-group {
  display: flex;
  justify-content: flex-end;
  padding: 10px 0;
}
.submit {
  background: #ff9620;
  color: #fff;
  width: 30%;
}

.cancele {
  background: rgb(218, 218, 218);
  color: #000;
  width: 30%;
  margin-right: 10px;
}
.invalid {
  color: red;
  margin-top: 5px;
}
.error {
  color: rgb(255, 97, 97);
  margin: 5px 0 0 0.8rem;
  text-align: left;
}
</style>
