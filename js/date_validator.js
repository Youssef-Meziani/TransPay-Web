function isValidDate(dateString) {
    // Extract day, month, and year from the date string
    var parts = dateString.split('/');
    var day = parseInt(parts[0], 10);
    var month = parseInt(parts[1], 10);
    var year = parseInt(parts[2], 10);

    // Create a new Date object with the extracted values
    var date = new Date(year, month - 1, day);

    // Check if the Date object represents a valid date
    return (
        date.getFullYear() === year &&
        date.getMonth() === month - 1 &&
        date.getDate() === day
    );
}