import { createStore } from 'vuex'

export default createStore({
  state: {
    user:null,
  },
  getters: {
    
  },
  mutations: {
    login (state,user) {
      state.user=user;
      localStorage.setItem('token', JSON.stringify(user.token));
      alert(user.token);
    },

    logout(state){
      state.user = null;
      localStorage.removeItem('token');
      alert('Logged out');
    },
    initialiseStore(state) {
      if(localStorage.getItem('token')){
        state.user = localStorage.getItem('token');
       }
    }
  },
  actions: {
  },
  modules: {
  }
})
