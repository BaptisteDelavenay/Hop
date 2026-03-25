function toggleAccordion(button) {
    const content = button.nextElementSibling;
    const icon = button.querySelector('svg');
    if (content.classList.contains('grid-rows-[0fr]')) {
        content.classList.replace('grid-rows-[0fr]', 'grid-rows-[1fr]');
        icon.classList.add('rotate-180');
    } else {
        content.classList.replace('grid-rows-[1fr]', 'grid-rows-[0fr]');
        icon.classList.remove('rotate-180');
    }
}