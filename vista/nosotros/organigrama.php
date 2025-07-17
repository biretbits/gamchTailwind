<?php require("vista/esquema/header.php"); ?>
<h6 align='center'class='p-8'>ORGANIGRAMA GOBIERNO AÚTONOMO MUNICIPAL DE CHALLAPATA</h6>

<div id="container"
   class="w-screen h-screen relative overflow-hidden bg-white cursor-crosshair touch-none select-none">
   <div id="imageContainer" class="w-full h-full relative overflow-hidden">
     <img id="mainImage" src="imagenes/organigrama.svg" alt="Organigrama"
       class="absolute transition-transform ease-out select-none">
     <div id="magnifier"
       class="hidden absolute w-[200px] h-[200px] border-4 border-blue-500 rounded-full bg-no-repeat pointer-events-none z-10 shadow-[0_0_20px_rgba(0,123,255,0.5)]">
     </div>
   </div>

   <div class="absolute top-5 right-5 z-20 flex flex-col gap-2 md:top-2 md:right-2">
     <button id="zoomIn"
       class="w-[50px] h-[50px] md:w-[40px] md:h-[40px] bg-blue-500 hover:bg-blue-600 text-white text-2xl md:text-xl rounded-full flex items-center justify-center"
       title="Acercar">+</button>
     <button id="zoomOut"
       class="w-[50px] h-[50px] md:w-[40px] md:h-[40px] bg-blue-500 hover:bg-blue-600 text-white text-2xl md:text-xl rounded-full flex items-center justify-center"
       title="Alejar">−</button>
     <button id="reset"
       class="w-[50px] h-[50px] md:w-[40px] md:h-[40px] bg-blue-500 hover:bg-blue-600 text-white text-2xl md:text-xl rounded-full flex items-center justify-center"
       title="Restablecer">⌂</button>
   </div>

   <div id="info"
     class="absolute bottom-5 left-5 md:bottom-2 md:left-2 bg-black bg-opacity-70 text-white text-sm md:text-xs px-4 py-2 md:px-3 md:py-1 rounded z-20">
     Zoom: 100% | Usa la rueda del mouse para zoom | Arrastra para mover
   </div>
 </div>
 <script>
 class OrganigramaViewer {
     constructor() {
         this.container = document.getElementById('container');
         this.imageContainer = document.getElementById('imageContainer');
         this.mainImage = document.getElementById('mainImage');
         this.magnifier = document.getElementById('magnifier');
         this.info = document.getElementById('info');

         this.scale = 1;
         this.minScale = 0.5;
         this.maxScale = 5;
         this.translateX = 0;
         this.translateY = 0;

         this.isDragging = false;
         this.lastX = 0;
         this.lastY = 0;

         this.isTouch = false;
         this.initialDistance = 0;
         this.initialScale = 1;

         this.init();
     }

     init() {
         this.setupEventListeners();
         this.centerImage();
         this.updateInfo();
     }

     setupEventListeners() {
         // Eventos del mouse
         this.container.addEventListener('mousemove', this.handleMouseMove.bind(this));
         this.container.addEventListener('mouseleave', this.hideMagnifier.bind(this));
         this.container.addEventListener('mousedown', this.handleMouseDown.bind(this));
         this.container.addEventListener('mousemove', this.handleMouseDrag.bind(this));
         this.container.addEventListener('mouseup', this.handleMouseUp.bind(this));

         // Eventos táctiles
         this.container.addEventListener('touchstart', this.handleTouchStart.bind(this), { passive: false });
         this.container.addEventListener('touchmove', this.handleTouchMove.bind(this), { passive: false });
         this.container.addEventListener('touchend', this.handleTouchEnd.bind(this));

         // Botones de zoom
         document.getElementById('zoomIn').addEventListener('click', () => this.zoom(1.2));
         document.getElementById('zoomOut').addEventListener('click', () => this.zoom(0.8));
         document.getElementById('reset').addEventListener('click', () => this.reset());

         // Prevenir comportamiento predeterminado
         this.container.addEventListener('contextmenu', e => e.preventDefault());
         this.mainImage.addEventListener('dragstart', e => e.preventDefault());
     }

     handleMouseMove(e) {
         if (!this.isDragging) {
             this.showMagnifier(e);
         }
     }

     showMagnifier(e) {
         if (this.isTouch) return;

         const rect = this.container.getBoundingClientRect();
         const x = e.clientX - rect.left;
         const y = e.clientY - rect.top;

         const imageRect = this.mainImage.getBoundingClientRect();
         const relativeX = (e.clientX - imageRect.left) / imageRect.width;
         const relativeY = (e.clientY - imageRect.top) / imageRect.height;

         if (relativeX >= 0 && relativeX <= 1 && relativeY >= 0 && relativeY <= 1) {
             this.magnifier.style.display = 'block';
             this.magnifier.style.left = (x - 100) + 'px';
             this.magnifier.style.top = (y - 100) + 'px';
             this.magnifier.style.backgroundImage = `url(${this.mainImage.src})`;
             this.magnifier.style.backgroundPosition =
                 `${-relativeX * this.mainImage.naturalWidth * 8 + 100}px ${-relativeY * this.mainImage.naturalHeight * 8 + 100}px`;
         } else {
             this.hideMagnifier();
         }
     }

     hideMagnifier() {
         this.magnifier.style.display = 'none';
     }

     handleMouseDown(e) {
         if (e.button === 0) {
             this.isDragging = true;
             this.lastX = e.clientX;
             this.lastY = e.clientY;
             this.container.style.cursor = 'grabbing';
             this.hideMagnifier();
         }
     }

     handleMouseDrag(e) {
         if (!this.isDragging) return;

         const deltaX = e.clientX - this.lastX;
         const deltaY = e.clientY - this.lastY;

         this.translateX += deltaX;
         this.translateY += deltaY;

         this.updateTransform();

         this.lastX = e.clientX;
         this.lastY = e.clientY;
     }

     handleMouseUp() {
         this.isDragging = false;
         this.container.style.cursor = 'crosshair';
     }

     handleTouchStart(e) {
         e.preventDefault();
         this.isTouch = true;
         this.hideMagnifier();

         if (e.touches.length === 1) {
             this.isDragging = true;
             this.lastX = e.touches[0].clientX;
             this.lastY = e.touches[0].clientY;
             this.container.classList.add('dragging');
         } else if (e.touches.length === 2) {
             this.isDragging = false;
             this.initialDistance = this.getDistance(e.touches[0], e.touches[1]);
             this.initialScale = this.scale;
         }
     }

     handleTouchMove(e) {
         e.preventDefault();

         if (e.touches.length === 1 && this.isDragging) {
             const deltaX = e.touches[0].clientX - this.lastX;
             const deltaY = e.touches[0].clientY - this.lastY;

             this.translateX += deltaX;
             this.translateY += deltaY;

             this.updateTransform();

             this.lastX = e.touches[0].clientX;
             this.lastY = e.touches[0].clientY;
         } else if (e.touches.length === 2) {
             const currentDistance = this.getDistance(e.touches[0], e.touches[1]);
             const scaleChange = currentDistance / this.initialDistance;
             const newScale = this.initialScale * scaleChange;

             this.setScale(newScale);
         }
     }

     handleTouchEnd(e) {
         this.isDragging = false;
         this.container.classList.remove('dragging');
         if (e.touches.length === 0) {
             setTimeout(() => {
                 this.isTouch = false;
             }, 300);
         }
     }

     getDistance(touch1, touch2) {
         const dx = touch2.clientX - touch1.clientX;
         const dy = touch2.clientY - touch1.clientY;
         return Math.sqrt(dx * dx + dy * dy);
     }

     zoom(factor) {
         this.setScale(this.scale * factor);
     }

     setScale(newScale) {
         this.scale = Math.max(this.minScale, Math.min(this.maxScale, newScale));
         this.updateTransform();
         this.updateInfo();
     }

     updateTransform() {
         this.mainImage.style.transform =
             `translate(${this.translateX}px, ${this.translateY}px) scale(${this.scale})`;
     }

     centerImage() {
         this.translateX = 0;
         this.translateY = 0;
         this.updateTransform();
     }

     reset() {
         this.scale = 1;
         this.translateX = 0;
         this.translateY = 0;
         this.updateTransform();
         this.updateInfo();
     }

     updateInfo() {
         const zoomPercent = Math.round(this.scale * 100);
         this.info.textContent = `Zoom: ${zoomPercent}% | Arrastra para mover | Usa los botones para hacer zoom`;
     }
 }

 document.addEventListener('DOMContentLoaded', () => {
     new OrganigramaViewer();
 });
 </script>


<?php require("vista/esquema/footeruni.php"); ?>
