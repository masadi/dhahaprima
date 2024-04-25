/*import io from 'socket.io-client';

const socket = io('http://localhost:4000', {reconnect: true}); // Ganti dengan URL server Socket.IO Anda

*/
import { io } from 'socket.io-client';
const socket = io('http://localhost:4000', {
  withCredentials: true,
  //reconnect: true,
});
export default socket;