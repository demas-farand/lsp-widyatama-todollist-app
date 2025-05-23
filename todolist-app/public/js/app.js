document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

    if (!csrfToken) {
        console.error('CSRF token not found!');
        return;
    }

    function moveTask(taskId, isCompleted) {
        const taskItem = document.querySelector(`.task-item[data-task-id="${taskId}"]`);
        if (!taskItem) return;

        taskItem.remove();

        const targetList = isCompleted
            ? document.getElementById('completedTasks')
            : document.getElementById('pendingTasks');

        targetList.appendChild(taskItem);

        const taskLabel = taskItem.querySelector('.form-check-label');
        if (taskLabel) {
            taskLabel.classList.toggle('text-decoration-line-through', isCompleted);
            taskLabel.classList.toggle('text-muted', isCompleted);
        }

        const checkbox = taskItem.querySelector('.task-checkbox');
        if (checkbox) {
            checkbox.checked = isCompleted;
        }
    }

    document.addEventListener('change', function(e) {
        if (e.target && e.target.classList.contains('task-checkbox')) {
            const checkbox = e.target;
            const form = checkbox.closest('form');
            const listItem = checkbox.closest('.list-group-item');

            if (!form || !listItem) return;

            const taskId = listItem.dataset.taskId;
            const isCompleted = checkbox.checked;

            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    moveTask(taskId, isCompleted);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                checkbox.checked = !isCompleted;
            });
        }
    });

    const addTaskForm = document.getElementById('addTaskForm');
    if (addTaskForm) {
        addTaskForm.addEventListener('submit', function(e) {
            e.preventDefault();
            fetch(this.action, {
                method: 'POST',
                body: new FormData(this),
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }
});
