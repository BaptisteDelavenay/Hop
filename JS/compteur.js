const animateCounter = (el) => {
    const target = +el.getAttribute('data-target'); 
    const duration = 1000; 
    const stepTime = 10; 
    const totalSteps = duration / stepTime;
    const increment = target / totalSteps;
    
    let current = 0;

    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            el.innerText = target.toLocaleString()+"%";
            clearInterval(timer);
        } else {
            el.innerText = Math.floor(current).toLocaleString()+"%";
        }
    }, stepTime);
};

const observerOptions = {
    threshold: 0.5 
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            animateCounter(entry.target);
            observer.unobserve(entry.target); 
        }
    });
}, observerOptions);

document.querySelectorAll('.js-counter').forEach(counter => {
    observer.observe(counter);
});