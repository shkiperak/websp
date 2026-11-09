 // --- ЛОГИКА ВЫЕЗЖАЮЩЕГО МЕНЮ ---
function toggleMenu() {
    const menu = document.getElementById('mobile-menu');
    // Если меню уехало влево (скрыто), выдвигаем его
    if (menu.classList.contains('-translate-x-full')) {
        menu.classList.remove('-translate-x-full');
        document.body.style.overflow = 'hidden'; // Запрещаем скролл фона
    } else {
        // Иначе убираем обратно
        menu.classList.add('-translate-x-full');
        document.body.style.overflow = 'auto'; // Возвращаем скролл
    }
}

// --- ЛОГИКА СЛАЙДЕРА КАРТИНОК ---
// Массив с ссылками на твои картинки (пока временные)
const slides = [
    "https://images.unsplash.com/photo-1541888946425-d81bb19240f5?q=80&w=2070&auto=format&fit=crop", // 1. Общая стройка
    "https://images.unsplash.com/photo-1513694203232-719a280e022f?q=80&w=2070&auto=format&fit=crop", // 2. Подвал
    "https://images.unsplash.com/photo-1590496793907-6b6e0059efc2?q=80&w=2070&auto=format&fit=crop", // 3. Инъекция
    "https://images.unsplash.com/photo-1504307651254-35680f356dfd?q=80&w=2070&auto=format&fit=crop", // 4. Бетон
    "https://images.unsplash.com/photo-1581094794329-c8112a89af12?q=80&w=2070&auto=format&fit=crop"  // 5. Работы
];

const imgElement = document.getElementById('slide-img');
const dots = document.querySelectorAll('#hero .absolute.bottom-6 button');
let currentSlide = 0;

function setSlide(index) {
    currentSlide = index;
    // Меняем картинку
    imgElement.style.opacity = 0; // Плавное затухание
    setTimeout(() => {
        imgElement.src = slides[index];
        imgElement.style.opacity = 0.7; // Появление
    }, 200);

    // Обновляем точки
    dots.forEach((dot, i) => {
        if (i === index) {
            dot.classList.remove('bg-white/50');
            dot.classList.add('bg-brand-lightblue');
        } else {
            dot.classList.remove('bg-brand-lightblue');
            dot.classList.add('bg-white/50');
        }
    });
}

// Автоматическое переключение каждые 5 секунд
setInterval(() => {
    let nextIndex = currentSlide + 1;
    if (nextIndex >= slides.length) nextIndex = 0;
    setSlide(nextIndex);
}, 5000);