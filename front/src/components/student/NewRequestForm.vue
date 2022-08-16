<template>
  <form>
    <h2>REQUEST LEAVE</h2>
    <div class="line"></div>
    <div class="form-group">
      <p>Leave Type :</p>
      <select class="form-control">
        <option value=""></option>
        <option value="sick">Sick</option>
        <option value="family event">Family Event</option>
        <option value="brother/sister married">Brother/Sister Married</option>
      </select>
    </div>
    <div class="form-group">
      <p>Start Date :</p>
      <div
        class="form-controll"
        style="display: flex; justify-content: space-between"
      >
        <input type="date" class="two-input" />
        <select class="two-input">
          <option value="Morning">Morning</option>
          <option value="Afternoon">Afternoon</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <p>End Date :</p>
      <div
        class="form-controll"
        style="display: flex; justify-content: space-between"
      >
        <input type="date" class="two-input" />
        <select class="two-input">
          <option value="Morning">Morning</option>
          <option value="Afternoon">Afternoon</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <p>Duration : <i>7 Days</i></p>
    </div>
    <div class="form-group">
      <p>Cause(Reason) :</p>
      <textarea cols="53" rows="5"></textarea>
    </div>
    <div class="form-group">
      <button class="form-control">Submit</button>
    </div>
  </form>
</template>

<script>
export default {
  data(){
    return{
      
    }
  }
};
</script>

<style scoped>
form {
  width: 30%;
  margin:2rem auto ;
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
  display: f;
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
i {
  color: red;
  font-weight: bold;
}
textarea {
  resize: none;
}
button {
  border: none;
  background: #e0a102;
  color: #fff;
  font-weight: bold;
}
</style>