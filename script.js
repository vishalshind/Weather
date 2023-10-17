document.addEventListener("DOMContentLoaded", function() {
    // Function to generate random temperature between 35 and 40 with one decimal point
    function generateRandomTemperature() {
        return (Math.floor(Math.random() * 60) + 350) / 10;
    }

    // Function to generate random humidity between 60 and 80 with one decimal point
    function generateRandomHumidity() {
        return (Math.floor(Math.random() * 210) + 600) / 10;
    }

    // Function to generate random wind speed between 10 and 35 with one decimal point
    function generateRandomWindSpeed() {
        return (Math.floor(Math.random() * 260) + 100) / 10;
    }

    // Function to generate a random date between September 5, 2023, and September 13, 2023
    function generateRandomDate() {
        const startDate = new Date("2023-09-05");
        const endDate = new Date("2023-09-13");
        const randomTime = startDate.getTime() + Math.random() * (endDate.getTime() - startDate.getTime());
        const randomDate = new Date(randomTime);
        return randomDate.toLocaleDateString("en-GB");
    }

    // Function to generate a random time in HH:mm format
    function generateRandomTime() {
        const hours = String(Math.floor(Math.random() * 24)).padStart(2, "0");
        const minutes = String(Math.floor(Math.random() * 60)).padStart(2, "0");
        return `${hours}:${minutes}`;
    }

    // Pre-fill the form fields with random values
    document.getElementById("updateTemperature").value = generateRandomTemperature();
    document.getElementById("updateHumidity").value = generateRandomHumidity();
    document.getElementById("updateWindSpeed").value = generateRandomWindSpeed();
    document.getElementById("updateDate").value = generateRandomDate();
    document.getElementById("updateTime").value = generateRandomTime();
});
