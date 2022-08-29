import { createRouter, createWebHistory } from 'vue-router'
import WelcomeView from ".././views/WelcomeView.vue"
import StudentsList from '../views/teacher/StudentsList.vue'
import CheckLeave from '../views/teacher/CheckStudentLeave.vue'
import StudentListAllLeave from '../views/student/StudentListAllLeave.vue'
import NewRequest from '../views/student/NewRequest.vue'
import StudentProfile from '../views/student/StudentProfile.vue'
import TeacherProfile from '../views/teacher/TeacherProfile.vue'
import Signin from "@/views/user/SignIn.vue"
const routes = [
  {
    path: '/',
    name: 'signin',
    component: Signin
  },

  {
    path: '/welcome',
    name: 'welcome',
    component: WelcomeView
  },

  {
    path: '/studentsList',
    name: 'studentsList',
    component: StudentsList
  },
  {
    path: '/checkLeave',
    name: 'checkLeave',
    component: CheckLeave
  },
  {
    path: '/studentListAllLeave',
    name: 'studentListAllLeave',
    component: StudentListAllLeave
  },
  {
    path: '/newRequest',
    name: 'newRequest',
    component: NewRequest
  },
  {
    path: '/profile',
    name: 'profile',
    component: StudentProfile
  }, 
  {
    path: '/TeacherProfile',
    name: 'TeacherProfile',
    component: TeacherProfile
  }, 
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router;