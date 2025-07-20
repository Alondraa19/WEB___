const chatToggleBtn = document.getElementById('chat-toggle');
  const chatContainer = document.getElementById('chat-container');
  const chatCloseBtn = document.getElementById('chat-close');
  const chatbox = document.getElementById('chatbox');
  const userInput = document.getElementById('userInput');
  const sendBtn = document.getElementById('sendBtn');

  // Mostrar/ocultar chat
  chatToggleBtn.addEventListener('click', () => {
    chatContainer.style.display = 'flex';
    chatToggleBtn.style.display = 'none';
    userInput.focus();
  });

  chatCloseBtn.addEventListener('click', () => {
    chatContainer.style.display = 'none';
    chatToggleBtn.style.display = 'block';
  });

  // Añadir mensaje al chat
  function appendMessage(sender, text) {
    const message = document.createElement('div');
    message.className = sender;
    message.textContent = (sender === 'user' ? "Tú: " : "Asistente 🤖: ") + text;
    chatbox.appendChild(message);
    chatbox.scrollTop = chatbox.scrollHeight;
  }

  // Respuestas básicas para la tienda
  function getBotResponse(input) {
    input = input.toLowerCase();
    if(input.includes('horario')) {
      return "Nuestro horario de atención es de Lunes a Viernes de 9:00 am a 18:00 pm y Sábados de 10:00 am a 14:00 pm.";
    }
    if(input.includes('contacto') || input.includes('teléfono') || input.includes('email')) {
      return "Puedes contactarnos al teléfono: 964530729 o al correo: info@gmail.com.";
    }
    if(input.includes('productos') || input.includes('artículos')) {
      return "Vendemos electrodomésticos, artículos para dormitorio, baño y terraza. ¿Quieres ver alguna categoría en particular?";
    }
    if(input.includes('ofertas')) {
      return "Actualmente tenemos ofertas especiales en Juegos de Toallas, Mesa de Terraza y Cortinas Modernas.";
    }
    if(input.includes('envío') || input.includes('delivery')) {
      return "Ofrecemos envío a todo el país con un costo adicional dependiendo de tu ubicación.";
    }
    if(input.includes('pago')) {
      return "Aceptamos pagos con tarjeta, transferencia bancaria y efectivo contra entrega.";
    }
    if(input.includes('gracias') || input.includes('ok') || input.includes('perfecto')) {
      return "¡Con gusto! Si tienes más preguntas, aquí estoy para ayudarte.";
    }
    return "Disculpa, no entendí tu pregunta. Puedes consultar sobre horarios, productos, ofertas, contacto y más.";
  }

  // Enviar mensaje
  function sendMessage() {
    const text = userInput.value.trim();
    if(!text) return;
    appendMessage('user', text);
    userInput.value = '';
    setTimeout(() => {
      const botReply = getBotResponse(text);
      appendMessage('bot', botReply);
    }, 500);
  }

  // Enviar mensaje con botón o Enter
  sendBtn.addEventListener('click', sendMessage);
  userInput.addEventListener('keypress', (e) => {
    if(e.key === 'Enter') {
      sendMessage();
    }
  });

  // Mensaje inicial
  window.addEventListener('load', () => {
    appendMessage('bot', "¡Hola! Soy el asistente de Homely. ¿En qué puedo ayudarte hoy?");
  });