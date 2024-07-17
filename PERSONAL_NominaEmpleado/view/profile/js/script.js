// Fetch server time
// Fetch server time
async function fetchServerTime() {
  try {
    const response = await fetch("time.php");
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    const data = await response.json();
    console.log("Server time fetched:", data.time);
    return data.time;
  } catch (error) {
    console.error("Error fetching time:", error);
    return null;
  }
}

// Update local clock
function updateLocalClock() {
  const clockElem = document.getElementById("reloj");
  const timeParts = clockElem.textContent.split(":");
  let hours = parseInt(timeParts[0]);
  let minutes = parseInt(timeParts[1]);
  let seconds = parseInt(timeParts[2]);

  seconds++;
  if (seconds >= 60) {
    seconds = 0;
    minutes++;
  }
  if (minutes >= 60) {
    minutes = 0;
    hours++;
  }
  if (hours >= 24) {
    hours = 0;
  }

  clockElem.textContent =
    hours.toString().padStart(2, "0") +
    ":" +
    minutes.toString().padStart(2, "0") +
    ":" +
    seconds.toString().padStart(2, "0");
}

// Initialize local clock
async function initializeLocalClock() {
  const serverTime = await fetchServerTime();
  if (serverTime) {
    const clockElem = document.getElementById("reloj");
    clockElem.textContent = serverTime;
    setInterval(updateLocalClock, 1000);
  } else {
    document.getElementById("reloj").textContent = "Error loading time";
  }
}

// Log attendance
async function logAsistencia() {
  const actionType = document.getElementById("actionType").value;

  document.getElementById("startTimer").disabled = true;

  const response = await fetch(`log_time.php?actionType=${actionType}`);
  if (!response.ok) {
    console.error("Error logging time:", response.statusText);
    document.getElementById("startTimer").disabled = false;
    return;
  }
  const loggedTime = await response.text();
  const logElem = document.getElementById("asistenciaLog");

  const timeEntry = document.createElement("div");
  timeEntry.textContent = loggedTime;
  logElem.appendChild(timeEntry);

  document.getElementById("startTimer").disabled = false;
}

document.addEventListener("DOMContentLoaded", initializeLocalClock);

// Timer logic
let timerInterval;
let startTime;
let pausedTime = 0;
let paused = false;
const initialTime = 6 * 60 * 60 * 1000 + 40 * 60 * 1000;

function updateTimerClock() {
  const clockElem = document.getElementById("clock1");
  const timeParts = clockElem.textContent.split(":");
  let hours = parseInt(timeParts[0]);
  let minutes = parseInt(timeParts[1]);
  let seconds = parseInt(timeParts[2]);

  if (seconds === 0 && minutes === 0 && hours === 0) {
    clearInterval(timerInterval);
    logTimer("Finalizado", clockElem.textContent, "Timer1");
    return;
  }

  seconds--;
  if (seconds < 0) {
    seconds = 59;
    minutes--;
  }
  if (minutes < 0) {
    minutes = 59;
    hours--;
  }

  clockElem.textContent =
    hours.toString().padStart(2, "0") +
    ":" +
    minutes.toString().padStart(2, "0") +
    ":" +
    seconds.toString().padStart(2, "0");
}

function initializeTimerClock() {
  const clockElem = document.getElementById("clock1");
  const [initialHours, initialMinutes, initialSeconds] = [
    Math.floor(initialTime / (60 * 60 * 1000)),
    Math.floor((initialTime % (60 * 60 * 1000)) / (60 * 1000)),
    Math.floor((initialTime % (60 * 1000)) / 1000),
  ];

  clockElem.textContent =
    initialHours.toString().padStart(2, "0") +
    ":" +
    initialMinutes.toString().padStart(2, "0") +
    ":" +
    initialSeconds.toString().padStart(2, "0");
}

function startTimer() {
  clearInterval(timerInterval);
  startTime = new Date().getTime();
  timerInterval = setInterval(updateTimerClock, 1000);

  document.getElementById("startTimer").disabled = true;
  document.getElementById("pauseTimer").disabled = false;
  document.getElementById("stopTimer").disabled = false;
  document.getElementById("tiempoAlmuerzo").disabled = false;
}

function pauseTimer() {
  clearInterval(timerInterval);
  paused = true;
  pausedTime += new Date().getTime() - startTime;

  startSecondTimer();

  document.getElementById("resumeTimer").disabled = false;
  document.getElementById("pauseTimer").disabled = true;
  document.getElementById("stopTimer").disabled = true;
  document.getElementById("tiempoAlmuerzo").disabled = true;

  const clock3Elem = document.getElementById("clock3");
  const currentPauseCount = parseInt(clock3Elem.textContent);
  clock3Elem.textContent = currentPauseCount + 1;
}

function pauseTimer2() {
  clearInterval(timerInterval);
  paused = true;
  pausedTime += new Date().getTime() - startTime;

  document.getElementById("resumeTimer").disabled = false;
  document.getElementById("pauseTimer").disabled = true;
  document.getElementById("stopTimer").disabled = true;

  document.getElementById("tiempoAlmuerzo").disabled = true;

  const clock3Elem = document.getElementById("clock3");
  const currentPauseCount = parseInt(clock3Elem.textContent);
  clock3Elem.textContent = currentPauseCount + 1;
}

function resumeTimer() {
  paused = false;
  startTime = new Date().getTime() - pausedTime;
  timerInterval = setInterval(updateTimerClock, 1000);
  pauseSecondTimer();
  pauseLunchTimer();

  document.getElementById("stopTimer").disabled = false;
  document.getElementById("pauseTimer").disabled = false;
  document.getElementById("resumeTimer").disabled = true;
  document.getElementById("tiempoAlmuerzo").disabled = false;
}

function stopTimer() {
  clearInterval(timerInterval);
  const clockElem = document.getElementById("clock1");
  const finalTime = clockElem.textContent;
  logTimer("Horas de trabajo cumplidas", finalTime, "Timer1");
  clockElem.textContent = "06:40:00";
  stopSecondTimer();

  document.getElementById("startTimer").disabled = true;
  document.getElementById("resumeTimer").disabled = true;
  document.getElementById("pauseTimer").disabled = true;
  document.getElementById("stopTimer").disabled = true;
  document.getElementById("tiempoAlmuerzo").disabled = true;

  const clock3Elem = document.getElementById("clock3");
  const dailyPauses = clock3Elem.textContent;
  clock3Elem.textContent = "0";

  fetch(`log_time.php?actionType=StopTimer&dailyPauses=${dailyPauses}`)
    .then((response) => response.text())
    .then((loggedTime) => {
      const pauseLogElem = document.getElementById("dailyPauseLog");
      const pauseEntry = document.createElement("div");
      pauseEntry.textContent = loggedTime;
      pauseLogElem.appendChild(pauseEntry);
    })
    .catch((error) => console.error("Error logging daily pauses:", error));
}

async function logTimer(action, time, timerType) {
  const response = await fetch(
    `log_time.php?action=${action}&time=${time}&actionType=${timerType}`
  );
  if (!response.ok) {
    console.error("Error logging timer:", response.statusText);
    return;
  }
  const loggedTime = await response.text();
  const logElem = document.getElementById(
    timerType === "Timer1" ? "timerLog" : "secondTimerLog"
  );

  const timeEntry = document.createElement("div");
  timeEntry.textContent = loggedTime;
  logElem.appendChild(timeEntry);
}

document.getElementById("startTimer").addEventListener("click", startTimer);
document.getElementById("pauseTimer").addEventListener("click", pauseTimer);
document.getElementById("resumeTimer").addEventListener("click", resumeTimer);
document.getElementById("stopTimer").addEventListener("click", stopTimer);

document.addEventListener("DOMContentLoaded", initializeTimerClock);

// Second timer logic
let secondTimerInterval;
let secondStartTime;
let secondPausedTime = 0;
let secondPaused = false;
const secondInitialTime = 20 * 60 * 1000;

function updateSecondTimerClock() {
  const clockElem = document.getElementById("clock2");
  const timeParts = clockElem.textContent.split(":");
  let minutes = parseInt(timeParts[0]);
  let seconds = parseInt(timeParts[1]);

  if (seconds === 0 && minutes === 0) {
    clearInterval(secondTimerInterval);
    logTimer("Finalizado", clockElem.textContent, "Timer2");
    return;
  }

  seconds--;
  if (seconds < 0) {
    seconds = 59;
    minutes--;
  }

  clockElem.textContent =
    minutes.toString().padStart(2, "0") +
    ":" +
    seconds.toString().padStart(2, "0");
}

function initializeSecondTimerClock() {
  const clockElem = document.getElementById("clock2");
  const [initialMinutes, initialSeconds] = [
    Math.floor(secondInitialTime / (60 * 1000)),
    Math.floor((secondInitialTime % (60 * 1000)) / 1000),
  ];

  clockElem.textContent =
    initialMinutes.toString().padStart(2, "0") +
    ":" +
    initialSeconds.toString().padStart(2, "0");
}

function startSecondTimer() {
  clearInterval(secondTimerInterval);
  secondStartTime = new Date().getTime();
  secondTimerInterval = setInterval(updateSecondTimerClock, 1000);
}

function pauseSecondTimer() {
  clearInterval(secondTimerInterval);
  secondPaused = true;
  secondPausedTime += new Date().getTime() - secondStartTime;
}

function resumeSecondTimer() {
  secondPaused = false;
  secondStartTime = new Date().getTime() - secondPausedTime;
  secondTimerInterval = setInterval(updateSecondTimerClock, 1000);
}

function stopSecondTimer() {
  clearInterval(secondTimerInterval);
  const clockElem = document.getElementById("clock2");
  const finalTime = clockElem.textContent;
  logTimer("Tiempo de receso cumplido", finalTime, "Timer2");
  clockElem.textContent = "20:00";
}

async function logSecondTimer(action, time) {
  const response = await fetch(
    `log_time.php?action=${action}&time=${time}&actionType=Timer2`
  );
  if (!response.ok) {
    console.error("Error logging second timer:", response.statusText);
    return;
  }
  const loggedTime = await response.text();
  const logElem = document.getElementById("secondTimerLog");

  const timeEntry = document.createElement("div");
  timeEntry.textContent = loggedTime;
  logElem.appendChild(timeEntry);
}

document.addEventListener("DOMContentLoaded", initializeSecondTimerClock);

// Lunch timer logic
let lunchTimerInterval;
let lunchStartTime;
let lunchPausedTime = 0;
let lunchPaused = false;
const lunchInitialTime = 30 * 60 * 1000;

function updateLunchTimerClock() {
  const clockElem = document.getElementById("clock4");
  const timeParts = clockElem.textContent.split(":");
  let minutes = parseInt(timeParts[0]);
  let seconds = parseInt(timeParts[1]);

  if (seconds === 0 && minutes === 0) {
    clearInterval(lunchTimerInterval);
    logTimer("Finalizado", clockElem.textContent, "LunchTimer");
    return;
  }

  seconds--;
  if (seconds < 0) {
    seconds = 59;
    minutes--;
  }

  clockElem.textContent =
    minutes.toString().padStart(2, "0") +
    ":" +
    seconds.toString().padStart(2, "0");
}

function initializeLunchTimerClock() {
  const clockElem = document.getElementById("clock4");
  const [initialMinutes, initialSeconds] = [
    Math.floor(lunchInitialTime / (60 * 1000)),
    Math.floor((lunchInitialTime % (60 * 1000)) / 1000),
  ];

  clockElem.textContent =
    initialMinutes.toString().padStart(2, "0") +
    ":" +
    initialSeconds.toString().padStart(2, "0");
}

function startLunchTimer() {
  clearInterval(lunchTimerInterval);
  lunchStartTime = new Date().getTime();
  lunchTimerInterval = setInterval(updateLunchTimerClock, 1000);

  pauseTimer2(); // Pausar el temporizador principal cuando inicie el almuerzo

  //document.getElementById("resumeLunchTimer").disabled = false;
  //document.getElementById("pauseLunchTimer").disabled = true;
  //document.getElementById("stopLunchTimer").disabled = true;

  // document.getElementById("tiempoAlmuerzo").disabled = true;
}

function pauseLunchTimer() {
  clearInterval(lunchTimerInterval);
  lunchPaused = true;
  lunchPausedTime += new Date().getTime() - lunchStartTime;

  // document.getElementById("resumeLunchTimer").disabled = false;
  //document.getElementById("pauseLunchTimer").disabled = true;
  //document.getElementById("stopLunchTimer").disabled = true;
}

function resumeLunchTimer() {
  lunchPaused = false;
  lunchStartTime = new Date().getTime() - lunchPausedTime;
  lunchTimerInterval = setInterval(updateLunchTimerClock, 1000);

  resumeTimer(); // Reanudar el temporizador principal cuando se pausa el almuerzo

  // document.getElementById("resumeLunchTimer").disabled = true;
  //document.getElementById("pauseLunchTimer").disabled = false;
  //document.getElementById("stopLunchTimer").disabled = false;
}

function stopLunchTimer() {
  clearInterval(lunchTimerInterval);
  const clockElem = document.getElementById("clock4");
  const finalTime = clockElem.textContent;
  logTimer("Finalizado", finalTime, "LunchTimer");
  clockElem.textContent = "60:00";

  // document.getElementById("resumeLunchTimer").disabled = true;
  //document.getElementById("pauseLunchTimer").disabled = true;
  //document.getElementById("stopLunchTimer").disabled = true;
}

document
  .getElementById("tiempoAlmuerzo")
  .addEventListener("click", startLunchTimer);
document
  .getElementById("pauseLunchTimer")
  .addEventListener("click", pauseLunchTimer);
document
  .getElementById("resumeLunchTimer")
  .addEventListener("click", resumeLunchTimer);
document
  .getElementById("stopLunchTimer")
  .addEventListener("click", stopLunchTimer);

// Pausar temporizador de almuerzo al continuar el principal
document.getElementById("resumeTimer").addEventListener("click", () => {
  resumeTimer();
  pauseLunchTimer();
});

document.addEventListener("DOMContentLoaded", initializeLunchTimerClock);
