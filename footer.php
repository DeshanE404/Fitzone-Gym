<script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
    <style>
  #chatbot-widget {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 350px;
    height: 600px;
    border: none;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    display: none;
    z-index: 9999;
  }

  #chatbot-toggle {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 60px;
    height: 60px;
    background-color: #0078ff;
    border-radius: 50%;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    background-image: url('https://cdn-icons-png.flaticon.com/512/4712/4712027.png'); /* chat icon */
    background-size: 60%;
    background-repeat: no-repeat;
    background-position: center;
    cursor: pointer;
    z-index: 10000;
  }
</style>

<div id="chatbot-toggle" onclick="toggleChatbot()"></div>

<iframe
  id="chatbot-widget"
  src="https://page.botpenguin.com/6860d3539719d50e561c2585/6860d2f222197e933ecb1056">
</iframe>

<script>
  function toggleChatbot() {
    const chatbot = document.getElementById("chatbot-widget");
    chatbot.style.display = chatbot.style.display === "none" ? "block" : "none";
  }
</script>
</body>
</html>