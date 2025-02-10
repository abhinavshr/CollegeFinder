document.querySelectorAll('.love-btn').forEach(button => {
    button.addEventListener('click', function () {
        const collegeId = this.getAttribute('data-college-id');
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        if (!csrfToken) {
            alert('CSRF token not found!');
            return;
        }

        fetch('/toggle-favorite', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({ college_id: collegeId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'added') {
                this.textContent = '💔 Remove Favorite';
            } else {
                this.textContent = '❤️ Favorite';
            }
        });
    });
});
