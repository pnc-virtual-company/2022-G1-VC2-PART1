<template>
  <form>
    <h2>REQUEST LEAVE</h2>
    <div class="line"></div>
    <div class="form-group">
      <p>Leave Type :</p>
      <select class="form-control" v-model="leaveType">
        <option value=""></option>
        <option value="family event">Family Event</option>
        <option value="check health">Check Health</option>
        <option value="sick">Sick</option>
        <option value="ceremony event">Ceremony Event</option>
        <option value="brother/sister married">brother/sister married</option>
      </select>
    </div>
    <div class="form-group">
      <p>Start Date :</p>
      <div
        class="form-controll"
        style="display: flex; justify-content: space-between"
      >
        <input required type="date" class="two-input" v-model="startDate" />
        <select class="two-input" v-model="startTime">
          <option value="Morning">Morning</option>
          <option value="Afternoon">Afternoon</option>
        </select>
      </div>
      <p class="invalid">{{ invalidStartDate }}</p>
    </div>
    <div class="form-group">
      <p>End Date :</p>
      <div
        class="form-controll"
        style="display: flex; justify-content: space-between"
      >
        <input required type="date" class="two-input" v-model="endDate" />
        <select class="two-input" v-model="endTime">
          <option value="Morning">Morning</option>
          <option value="Afternoon">Afternoon</option>
        </select>
      </div>
      <p class="invalid">{{ invalidEndDate }}</p>
    </div>
    <div class="form-group">
      <p>
        Duration : <span v-if="duration == 0">0 Days</span
        ><span v-else>{{ duration }} Days</span>
      </p>
    </div>
    <div class="form-group">
      <p>Cause(Reason) :</p>
      <textarea cols="53" rows="5" v-model="cause"></textarea>
    </div>

    <div class="form-group">
      <div class="form-controll btn-group">
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
        >
          Submit
        </button>
      </div>
    </div>
  </form>
</template>

<script>
import http from "../../axios-http";
import moment from "moment";
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
      student_id: "",
    };
  },

  methods: {
    canceleRequest() {
      this.leaveType = "";
      this.startDate = "";
      this.endDate = "";
      this.cause = "";
    },

    addRequestLeave() {
      let requestleave = {
        leave_type: this.leaveType,
        start_date: this.startDate,
        end_date: this.endDate,
        duration: 6,
        reason: this.cause,
        student_id: 1,
      };
      http.post("studentleaveRequest", requestleave).then((res) => {
        console.log(res);
        this.leaveType = "";
        this.startDate = "";
        this.endDate = "";
        this.cause = "";
      });
    },
  },

  computed: {
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
    duration() {
      // var formatted_date = new Date().toJSON().slice(0, 10).replace(/-/g, "-");
      // console.log(formatted_date);
      // console.log(this.startDate);
      let result = 0;

      if (this.invalidEndDate == "" && this.invalidStartDate == "") {
        let start = moment(this.startDate);
        let end = moment(this.endDate);
        if (!isNaN(end.diff(start, "days"))) {
          if (this.startDate == this.endDate) {
            if (this.startTime == this.endTime) {
              result = 0.5;
            }
          } else {
            result = end.diff(start, "days");
          }
        }
      }
      return result;
    },
  },
};
</script>

<style scoped>
form {
  width: 30%;
  margin: 2rem auto;
  padding: 10px;
  background: #144e5a;
  border: 2px solid rgba(233, 233, 233, 0.54);
  border-radius: 15px;
}
h2 {
  text-align: center;
  color: #3cabce;
  margin: 1rem;
}
.form-group {
  margin: 10px;
}
.form-control {
  box-sizing: border-box;
  padding: 7px;
  width: 100%;
  border-radius: 5px;
}
p {
  color: #fff;
  font-weight: 100;
  margin-bottom: 7px;
}
.two-input {
  padding: 7px;
  border-radius: 5px;
  width: 46%;
}
span {
  color: red;
  font-weight: bold;
}
textarea {
  resize: none;
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
  background: orange;
  color: #fff;
  width: 30%;
}

.cancele {
  background: #fff;
  color: #000;
  width: 30%;
  margin-right: 10px;
}
.invalid {
  color: red;
  margin-top: 5px;
}
</style>