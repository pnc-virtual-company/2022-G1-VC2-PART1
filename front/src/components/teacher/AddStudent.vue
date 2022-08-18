<template>
  <form @submit.prevent="">
    <div class="username">
        <div class="inputname">
            <label for="">First Name:</label>
            <input
              class="firstname"
              type="text"
              placeholder="First Name"
              v-model="firstName"
            />
           
        </div>
        <div class="inputname">
             <label for="" class="lastName">Last Name:</label>
            <input
              class="lastname"
              type="text"
              placeholder="Last Name"
              v-model="lastName"
            />
        </div>
    </div>
    <div class="email">
        <label for="">Email:</label>
        <input
        class="form-group"
        type="text"
        placeholder="email"
        v-model="email"
        />
    </div>
    <div class="password">
        <label for="">Password:</label>
        <input
        class="form-group"
        type="text"
        placeholder="password"
        v-model="password"
        />
    </div>


    <div class="username">
        <div class="inputname">
            <label for="">Class:</label>
            <input
              class="classroom"
              type="text"
              v-model="classroom"
            />
           
        </div>
        <div class="inputname">
             <label for="" class="lastName">Generation:</label>
            <input
              class="generation"
              type="text"
              v-model="generation"
            />
        </div>
    </div>
    <button class="form-group btn" type="submit">ADD</button>
  </form>
</template>

<script>
export default {

}
</script>

<style scoped>
    form {
  width: 40%;
  padding: 20px;
  margin: auto;
  margin-top: 20px;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.26);
  background: #144e5a;
}
.form-group {
  width: 100%;
  padding: 10px;
  margin-bottom: 16px;
  border: solid 1px rgb(124, 117, 117);
  border-radius: 5px;
  box-sizing: border-box;
  outline: none;
  margin-top: 5px;
}
.btn {
  background: orange;
  border: none;
  color: #fff;

}

.firstname, .lastname, .classroom, .generation {
    width: 100%;
    padding: 10px;
  margin-bottom: 16px;
  border: solid 1px rgb(124, 117, 117);
  border-radius: 5px;
  box-sizing: border-box;
  outline: none;

}

.classroom

.username{
    display: flex;
}

.inputname{
    display:block;
}

.lastname, .generation{
    margin-left: 5px;
}
</style>