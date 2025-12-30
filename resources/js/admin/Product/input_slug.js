function slugify(text) {
    return text
        .toLowerCase()
        .trim()
        // chuyển tiếng Việt có dấu → không dấu
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .replace(/đ/g, 'd')
        // space → -
        .replace(/\s+/g, '-')
        // bỏ ký tự đặc biệt
        .replace(/[^a-z0-9\-]/g, '')
        // bỏ -- dư
        .replace(/\-+/g, '-');
}

const nameInput = document.getElementById('name');
const slugInput = document.getElementById('slug');

nameInput.addEventListener('blur', () => {
    if (slugInput.value.trim() === '') {
        slugInput.value = slugify(nameInput.value);
    }
});