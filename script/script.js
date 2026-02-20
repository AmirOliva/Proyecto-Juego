document.addEventListener("DOMContentLoaded", () => {

    const botonesCat = document.querySelectorAll(".cat");
    const contenedorCategorias = document.getElementById("categorias");
    const contenedorJuego = document.getElementById("juego");
    const barraUsuario = document.getElementById("barraUsuario");
    const spanVidas = document.getElementById("vidas");
    const spanTiempo = document.getElementById("tiempo");
    const spanPuntos = document.getElementById("puntos");

    let categoriaSeleccionada = "";
    let preguntas = [];
    let indicePregunta = 0;
    let vidas = 3;
    let tiempo = 15;
    let puntos = 0;
    let timer;

 
    const preguntasMates = [

        {pregunta: "¿Cuánto es 8 x 7?", opciones:["54","56","49","64"], correcta:1},
        {pregunta: "¿Cuánto es 12 + 15?", opciones:["25","27","30","28"], correcta:1},
        {pregunta: "¿Cuántos lados tiene un hexágono?", opciones:["6","5","7","8"], correcta:0},
        {pregunta: "¿Qué número sigue al 99?", opciones:["98","101","100","110"], correcta:2}, 
        {pregunta: "¿Cuánto es la mitad de 50?", opciones:["15","20","30","25"], correcta:3},

        {pregunta: "¿Cuál es la raíz cuadrada de 144?", opciones:["10","14","12","16"], correcta:2},
        {pregunta: "¿Cuánto es 150 / 3?", opciones:["50","40","60","45"], correcta:0},
        {pregunta: "¿Cómo se llama el polígono de 5 lados?", opciones:["Hexágono","Pentágono","Heptágono","Cuadrado"], correcta:1},
        {pregunta: "¿Cuántos minutos hay en 3 horas?", opciones:["120","150","180","200"], correcta:2},
        {pregunta: "Si un triángulo tiene un ángulo de 90°, es un...", opciones:["Isósceles","Rectángulo","Escaleno","Equilátero"], correcta:1}, 

        {pregunta: "¿Cuál es el valor de Pi aproximado?", opciones:["3.14","3.12","3.16","3.18"], correcta:0},
        {pregunta: "¿Qué nombre recibe el lado más largo de un triángulo rectángulo?", opciones:["Cateto","Radio","Eje","Hipotenusa"], correcta:3},
        {pregunta: "¿Cuál es el resultado de 2 elevado a 5 (2^5)?", opciones:["16","32","64","25"], correcta:1},
        {pregunta: "Si X + 15 = 30, ¿cuánto vale X?", opciones:["10","20","5","15"], correcta:3}, 
        {pregunta: "¿A cuánto equivale el número romano LX?", opciones:["60","40","50","70"], correcta:0} 
    ];



    const preguntasHistoria = [

        {pregunta: "Cristóbal Colón llegó a América en 1492", opciones:["Verdadero","Falso"], correcta:0},
        {pregunta: "La Primera Guerra Mundial terminó en 1939", opciones:["Verdadero","Falso"], correcta:1},
        {pregunta: "Las pirámides de Giza fueron construidas en Egipto", opciones:["Verdadero","Falso"], correcta:0},
        {pregunta: "Los Juegos Olímpicos nacieron en Roma", opciones:["Verdadero","Falso"], correcta:1},
        {pregunta: "El barco de Colón se llamaba 'La Santa María'", opciones:["Verdadero","Falso"], correcta:0},

        {pregunta: "Neil Armstrong fue el primer hombre en pisar la Luna", opciones:["Verdadero","Falso"], correcta:0},
        {pregunta: "La Revolución Francesa comenzó en el año 1789", opciones:["Verdadero","Falso"], correcta:0},
        {pregunta: "Napoleón Bonaparte era de nacionalidad inglesa", opciones:["Verdadero","Falso"], correcta:1},
        {pregunta: "Simón Bolívar es conocido como 'El Libertador'", opciones:["Verdadero","Falso"], correcta:0},
        {pregunta: "El Muro de Berlín cayó en el año 1975", opciones:["Verdadero","Falso"], correcta:1},


        {pregunta: "La penicilina fue descubierta por Alexander Fleming", opciones:["Verdadero","Falso"], correcta:0},
        {pregunta: "Julio César fue el primer emperador oficial de Roma", opciones:["Verdadero","Falso"], correcta:1},
        {pregunta: "La batalla de Waterloo ocurrió en el siglo XIX", opciones:["Verdadero","Falso"], correcta:0},
        {pregunta: "La escritura cuneiforme fue inventada por los Egipcios", opciones:["Verdadero","Falso"], correcta:1},
        {pregunta: "El Imperio Romano de Oriente cayó antes que el de Occidente", opciones:["Verdadero","Falso"], correcta:1}
    ];

    const preguntasBanderas = [
        {imagen: "../imagenes/españa.jpg", opciones:["España","Francia","Italia","Alemania"], correcta:0},
        {imagen: "../imagenes/francia.jpg", opciones:["Bélgica","Francia","Holanda","Italia"], correcta:1},
        {imagen: "../imagenes/peru.jpg", opciones:["austria","argentina","Polonia","Peru"], correcta:3},
        {imagen: "../imagenes/jamaica.png", opciones:["Rusia","Jamaica","Nicaragua","Haite"], correcta:1},
        {imagen: "../imagenes/holanda.jpg", opciones:["Paises bajos","Alemania","Holanda","Italia"], correcta:2},
        {imagen: "../imagenes/salvador.png", opciones:["El Salvador","Urugua","Paragua","Honduras"], correcta:1}
    ];

    const preguntasMarcas = [
        {imagen: "../imagenes/nike.jpg", opciones:["Nike","Adidas","Puma","Reebok"], correcta:0},
        {imagen: "../imagenes/mcdonal.png", opciones:["Burger King","McDonald's","KFC","Subway"], correcta:1},
        {imagen: "../imagenes/apple.png", opciones:["Samsung","Apple","Sony","Microsoft"], correcta:1},
        {imagen: "../imagenes/adidas.jpg", opciones:["Puma","New Balance","Nike","Adidas"], correcta:3},
        {imagen: "../imagenes/chanel.png", opciones:["Nike","Tous","Gucci","Chanel"], correcta:3},
        {imagen: "../imagenes/citroen.jpg", opciones:["Toyota","Citroen","Peugeot","Seat"], correcta:2}
    ];

    botonesCat.forEach(btn => {
        btn.addEventListener("click", () => {
            categoriaSeleccionada = btn.dataset.cat;
            

            contenedorCategorias.style.display = "none";
            if(barraUsuario) barraUsuario.style.display = "none";

            contenedorJuego.style.display = "block";
            iniciarJuego();
        });
    });

    function iniciarJuego() {
        indicePregunta = 0;
        vidas = 3;
        tiempo = 15;
        puntos = 0;

        if(categoriaSeleccionada === "mates") preguntas = preguntasMates;
        else if(categoriaSeleccionada === "historia") preguntas = preguntasHistoria;
        else if(categoriaSeleccionada === "banderas") preguntas = preguntasBanderas;
        else if(categoriaSeleccionada === "imagen") preguntas = preguntasMarcas;


        if(categoriaSeleccionada === "banderas" || categoriaSeleccionada === "imagen") {
            document.getElementById("imagenBandera").style.display = "block";
            document.getElementById("pregunta").style.display = "none";
        } else {
            document.getElementById("imagenBandera").style.display = "none";
            document.getElementById("pregunta").style.display = "block";
        }

        cargarPregunta();
        iniciarTemporizador();
    }

    function cargarPregunta() {
        if(indicePregunta >= preguntas.length){
            finalizarJuego();
            return;
        }

        const preguntaActual = preguntas[indicePregunta];
        const textoPregunta = document.getElementById("pregunta");
        const imagen = document.getElementById("imagenBandera");
        const opciones = document.querySelectorAll(".opcion");

        if(categoriaSeleccionada === "banderas" || categoriaSeleccionada === "imagen") {
            imagen.src = preguntaActual.imagen;
        } else {
            textoPregunta.textContent = preguntaActual.pregunta;
        }

        opciones.forEach((btn, index) => {
            if(preguntaActual.opciones[index] !== undefined){
                btn.style.display = "block";
                btn.textContent = preguntaActual.opciones[index];
                btn.onclick = () => comprobarRespuesta(index);
            } else {
                btn.style.display = "none";
            }
        });

        tiempo = 15;
        actualizarInfo();
    }

    function comprobarRespuesta(opcionElegida) {
        if(opcionElegida === preguntas[indicePregunta].correcta) puntos += 10;
        else vidas--;

        indicePregunta++;
        if(vidas <= 0 || indicePregunta >= preguntas.length) finalizarJuego();
        else cargarPregunta();
    }

    function actualizarInfo() {
        spanVidas.textContent = "❤️".repeat(vidas > 0 ? vidas : 0);
        spanTiempo.textContent = `⏱️ ${tiempo}`;
        spanPuntos.textContent = "⭐ " + puntos;
    }

    function iniciarTemporizador() {
        clearInterval(timer);
        timer = setInterval(() => {
            tiempo--;
            actualizarInfo();
            if(tiempo <= 0){
                vidas--;
                indicePregunta++;
                if(vidas <= 0 || indicePregunta >= preguntas.length) finalizarJuego();
                else cargarPregunta();
            }
        }, 1000);
    }

    function finalizarJuego() {
        clearInterval(timer);
        const datos = new URLSearchParams();
        datos.append('puntos', puntos);
        datos.append('categoria', categoriaSeleccionada);

        fetch('../php/guardar_puntaje.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: datos.toString() 
        })
        .then(res => res.text())
        .then(data => {
            alert(`Juego terminado 🎉\nPuntos: ${puntos}`);
            location.reload(); // 
        });
    }
});