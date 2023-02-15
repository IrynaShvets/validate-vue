import axios from 'axios';

export const axiosInstance = axios.create({
  baseURL: 'http://localhost',
  headers: {
    "Content-type": "application/json",
    credentials: 'include',
}
});

