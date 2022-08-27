
import axios from "axios";

let axiosApi=axios.create({
  baseURL: process.env.VUE_APP_API_URL, 
  headers: {"Content-type": "application/json"}});

  axiosApi.interceptors.request.use(function (config) {
  const token = localStorage.getItem("accessToken");
  config.headers.Authorization = token ? `Bearer ${token}` : "";
  return config;
});
export default axiosApi;
