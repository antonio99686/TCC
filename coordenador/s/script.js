document.addEventListener('DOMContentLoaded', function() {
    const monthYearElement = document.getElementById('month-year');
    const daysElement = document.getElementById('calendar-days');
    const prevMonthButton = document.getElementById('prev-month');
    const nextMonthButton = document.getElementById('next-month');

    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();

    const mensalidades = [
        { date: '2024-07-05', status: 'paid' },
        { date: '2024-07-10', status: 'pending' },
        { date: '2024-07-15', status: 'paid' },
        { date: '2024-07-20', status: 'pending' },
        // Adicione mais mensalidades conforme necessário
    ];

    function renderCalendar(month, year) {
        const firstDay = new Date(year, month).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        daysElement.innerHTML = '';

        monthYearElement.textContent = new Date(year, month).toLocaleDateString('pt-BR', { month: 'long', year: 'numeric' });

        for (let i = 0; i < firstDay; i++) {
            const emptyDiv = document.createElement('div');
            emptyDiv.classList.add('calendar-day', 'empty', 'col');
            daysElement.appendChild(emptyDiv);
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const dayDiv = document.createElement('div');
            dayDiv.classList.add('calendar-day', 'col');
            dayDiv.textContent = day;

            const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const mensalidade = mensalidades.find(m => m.date === dateStr);
            if (mensalidade) {
                dayDiv.classList.add(mensalidade.status);
            }

            daysElement.appendChild(dayDiv);
        }
    }

    prevMonthButton.addEventListener('click', () => {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar(currentMonth, currentYear);
    });

    nextMonthButton.addEventListener('click', () => {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar(currentMonth, currentYear);
    });

    renderCalendar(currentMonth, currentYear);
});
