const sortDirection = [1, 1, 1, 1, 1, 1, 1, 1]; // 1 for ascending, -1 for descending

// Set default "From Date" and "To Date" values to the current day
const currentDate = new Date().toISOString().split('T')[0];
document.getElementById('from-date').value = currentDate;
document.getElementById('to-date').value = currentDate;

function sortTable(columnIndex) {
    const table = document.getElementById('sortable-table');
    const rows = Array.from(table.getElementsByTagName('tr'));
    const headerRow = rows.shift();
    const headerCells = headerRow.getElementsByTagName('th');

    // Toggle sort direction
    sortDirection[columnIndex] *= -1;

    // Reset sort indicators on all headers
    for (let i = 0; i < headerCells.length; i++) {
        headerCells[i].textContent = headerCells[i].textContent.replace(' ▲', '').replace(' ▼', '');
    }

    headerCells[columnIndex].textContent += (sortDirection[columnIndex] === 1) ? ' ▲' : ' ▼';

    rows.sort((a, b) => {
        const aValue = a.getElementsByTagName('td')[columnIndex].textContent.trim();
        const bValue = b.getElementsByTagName('td')[columnIndex].textContent.trim();

        if (columnIndex === 0) { // Date & Time column
            const aDateTime = new Date(aValue);
            const bDateTime = new Date(bValue);

            return (aDateTime - bDateTime) * sortDirection[columnIndex];
        } else if (!isNaN(parseFloat(aValue)) && !isNaN(parseFloat(bValue))) { // Numeric columns
            return (parseFloat(aValue) - parseFloat(bValue)) * sortDirection[columnIndex];
        } else { // String columns
            return aValue.localeCompare(bValue) * sortDirection[columnIndex];
        }
    });

    const sortedTable = document.createElement('tbody');
    sortedTable.appendChild(headerRow);
    rows.forEach(row => sortedTable.appendChild(row));
    table.replaceChild(sortedTable, table.getElementsByTagName('tbody')[0]);
}

function filterTableByDateAndSensor() {
    const fromDate = new Date(document.getElementById('from-date').value);
    const toDate = new Date(document.getElementById('to-date').value);
    const selectedSensor = document.getElementById('sensor-select').value;
    const table = document.getElementById('sortable-table');
    const rows = Array.from(table.getElementsByTagName('tr'));

    rows.forEach(row => {
        const dateValue = new Date(row.getElementsByTagName('td')[0].textContent.trim());
        const sensorValue = row.getElementsByTagName('td')[7].textContent.trim();
        if (
            dateValue >= fromDate &&
            dateValue <= toDate &&
            (selectedSensor === sensorValue)
        ) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}


// Retrieve previous selections from localStorage and set them as default values
const savedSensor = localStorage.getItem('selectedSensor');
const savedFromDate = localStorage.getItem('selectedFromDate');
const savedToDate = localStorage.getItem('selectedToDate');

if (savedSensor) {
    document.getElementById('sensor-select').value = savedSensor;
}

if (savedFromDate) {
    document.getElementById('from-date').value = savedFromDate;
}

if (savedToDate) {
    document.getElementById('to-date').value = savedToDate;
}

// Listen for form submission and save selections to localStorage
document.getElementById('filter-form').addEventListener('submit', function (event) {
    const selectedSensor = document.getElementById('sensor-select').value;
    const selectedFromDate = document.getElementById('from-date').value;
    const selectedToDate = document.getElementById('to-date').value;

    localStorage.setItem('selectedSensor', selectedSensor);
    localStorage.setItem('selectedFromDate', selectedFromDate);
    localStorage.setItem('selectedToDate', selectedToDate);
});