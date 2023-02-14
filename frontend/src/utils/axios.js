import axios from 'axios';

const axiosInstance = axios.create({
  baseURL: 'http://backend',
  headers: {
    "Content-type": "application/json",
    credentials: 'include',
    mode: "no-cors",
}
});

export default axiosInstance;
