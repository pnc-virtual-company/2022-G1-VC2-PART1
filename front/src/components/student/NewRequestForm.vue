<template>
  <form>
    <h2>REQUEST LEAVE</h2>
    <div class="form-group">
      <p>Leave Type :</p>
      <select class="form-control" v-model="leaveType">
        <option value="" selected disabled>Choose your leave type</option>
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
        style="display: flex; justify-content: space-between;"
      >
        <input required type="date" class="two-input" v-model="startDate" :min="getCurrentDate" />
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
        <input required type="date" class="two-input" v-model="endDate" :min="getCurrentDate" />
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
      <textarea cols="53" rows="5" v-model="cause" class="textarea"></textarea>
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
          :disabled="startDate > endDate"
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
      student_id: "",
    };
  },

  methods: {
    canceleRequest() {
      this.leaveType = "";
      this.startDate = "";
      this.endDate = "";
      this.cause = "";
      this.startTime ="";
      this.endTime = ""
    },

    addRequestLeave() {
      let requestleave = {
        leave_type: this.leaveType,
        start_date: this.startDate,
        end_date: this.endDate,
        duration: this.duration,
        reason: this.cause,
        student_id: 2,
      };
      http.post("studentleaveRequest", requestleave).then((res) => {
        swal({
            title: "Good job!",
            text: "You have create request successfully !",
            icon: "success",
          });
        console.log(res);
        this.leaveType = "";
        this.startDate = "";
        this.endDate = "";
        this.cause = "";
        this.startTime = "";
        this.endTime = ""
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
        tday = "0" + tday
      }
      if (month < 10) {
        month = "0" + month
      }
      return year + "-" + month + "-" + tday
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
    // disabple_button (){
    //   if(this.startDate > this.endDate){
    //     // return "";
    //   }
    //   return "";
    // },

    /**
     * Duration is use for calulate duration that student ask permission
     * @paramater dateTime is use for calulate end and start date
     */
    duration() {
    let notEmpty = this.startDate !="" && this.endDate !="" ;
        let isStart = this.startDate == this.endDate && this.startDate !="" && this.endDate !="" ;
        let halfDay =(this.startTime ==this.endTime);
        let halfTime = (this.startTime !="" && this.endTime != "")

        let dateforLeave = moment(this.startDate, "YYYY.MM.DD HH:mm").diff(moment(this.endDate, "YYYY.MM.DD HH:mm"));
        let dateTime = 0;
        
        if(dateforLeave <0 || dateforLeave == 0){
          
          if ((notEmpty ) && (halfTime)) {
            dateTime = Math.abs(moment(this.startDate, "YYYY.MM.DD HH:mm").diff(moment(this.endDate, "YYYY.MM.DD HH:mm"),"days"));
              } 
              if(isStart && halfDay && halfTime){
                dateTime += 0.5;
              }
              else if(halfDay && notEmpty && halfTime){
                dateTime +=0.5
              }
              else if(!halfDay && halfTime) {
                dateTime +=1
              }
        }
       
        console.log(dateforLeave);
        return dateTime;

    },
  },
};
</script>

<style scoped>
form {
  width: 30%;
  margin: 2rem auto;
  padding: 10px;
  box-shadow: rgb(177, 176, 176) 0px 5px 15px;
  border-radius: 15px;
}
h2 {
  text-align: center;
  color: #23BBEA;
  margin: 1rem;
}
.form-group {
  margin: 10px;
}
.form-control {
  box-sizing: border-box;
  padding: 13px;
  font-size: 15px;
  width: 100%;
  border-radius: 5px;
  /* border: none; */
  /* border-bottom: 2px solid #23BBEA;
  border-left:2px solid #23BBEA ;
  border-right:2px solid #23BBEA ; */
  border: 1.5px solid rgb(177, 176, 176);
  outline: none;

}

.textarea{
  outline: none;
  border-radius: 5px;
  resize: none;
  border: 1.5px solid rgb(177, 176, 176);

}
p {
  font-weight: 400;
  margin-bottom: 10px;
  outline: none;
  /* color: #23BBEA; */

}
.two-input {
  padding: 7px;
  border-radius: 5px;
  width: 46%;
  outline: none;
  border: 1.5px solid rgb(177, 176, 176);
}
span {
  color:#FF9620 ;
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
  background: #FF9620;
  color: #fff;
  width: 30%;
}

.cancele {
  background:rgb(218, 218, 218);
  color: #000;
  width: 30%;
  margin-right: 10px;
}
.invalid {
  color: red;
  margin-top: 5px;
}
</style>