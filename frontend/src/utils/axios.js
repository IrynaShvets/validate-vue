import axios from 'axios';

export const axiosInstance = axios.create({
  baseURL: 'https://localhost',
  headers: {
    "Content-type": "application/json",
    credentials: 'include',
}
});

