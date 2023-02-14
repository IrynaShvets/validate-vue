import axios from 'axios';

const axiosInstance = axios.create({
  baseURL: 'http://validator.php',
});

export default axiosInstance;
