<!-- Chat Box -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
#chatbox { position: fixed; bottom: 20px; right: 20px; width: 350px; max-height: 500px; border: 1px solid #ccc; background: #fff; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.3); display: flex; flex-direction: column; overflow: hidden; font-family: Arial, sans-serif; z-index: 9999; }
#chatbox_header { background: #d35400; color: #fff; padding: 10px; cursor: pointer; font-weight: bold; display: flex; justify-content: space-between; align-items: center; }
#chatbox_body { flex: 1; padding: 10px; overflow-y: auto; background: #f9f9f9; }
#chatbox_input { display: flex; border-top: 1px solid #ccc; }
#chatbox_input input { flex: 1; border: none; padding: 10px; }
#chatbox_input button { border: none; background: #d35400; color: #fff; padding: 10px 15px; cursor: pointer; }
.chat-message { margin-bottom: 10px; }
.chat-message.user { text-align: right; font-weight: bold; }
.chat-message.bot { text-align: left; font-style: italic; color: #555; }
.chat-message a { color: #d35400; text-decoration: none; display: block; margin-bottom: 5px; }
</style>

<div id="chatbox">
  <div id="chatbox_header">
    Chat with Furniture House
    <span id="chatbox_close" style="cursor:pointer;">&times;</span>
  </div>
  <div id="chatbox_body">
    <div class="chat-message bot">Hello! Welcome to Furniture House. Ask me about our products, contact info, or location.</div>
  </div>
  <div id="chatbox_input">
    <input type="text" id="user_msg" placeholder="Type your message..." />
    <button id="send_msg"><i class="fas fa-paper-plane"></i></button>
  </div>
</div>

<script>
const chatbox = document.getElementById('chatbox');
const chatBody = document.getElementById('chatbox_body');
const userInput = document.getElementById('user_msg');
const sendBtn = document.getElementById('send_msg');
const closeBtn = document.getElementById('chatbox_close');

closeBtn.addEventListener('click', () => { chatbox.style.display='none'; });

function appendMessage(sender,text){
  const div=document.createElement('div');
  div.classList.add('chat-message',sender);
  div.innerHTML=text;
  chatBody.appendChild(div);
  chatBody.scrollTop = chatBody.scrollHeight;
}

sendBtn.addEventListener('click',()=>{
  const msg=userInput.value.trim();
  if(msg==="") return;
  appendMessage('user',msg);
  userInput.value="";

  fetch('chat_response.php',{
    method:'POST',
    headers:{'Content-Type':'application/x-www-form-urlencoded'},
    body:'msg='+encodeURIComponent(msg)
  })
  .then(response=>response.text())
  .then(data=>appendMessage('bot',data));
});

userInput.addEventListener('keypress',(e)=>{
  if(e.key==='Enter') sendBtn.click();
});
</script>
