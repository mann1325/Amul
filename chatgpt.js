// Full Code: Display Events and Student Profiles using Object Arrays and JSON Parsing

// Sample JSON data as a string (can also be fetched from a file or server)
const jsonData = `
{
  "events": [
    {
      "id": 1,
      "title": "Science Fair",
      "date": "2025-08-10",
      "location": "Main Hall"
    },
    {
      "id": 2,
      "title": "Art Exhibition",
      "date": "2025-09-05",
      "location": "Art Gallery"
    },
    {
      "id": 3,
      "title": "Tech Talk",
      "date": "2025-10-15",
      "location": "Auditorium"
    }
  ],
  "students": [
    {
      "id": "S101",
      "name": "Alice Johnson",
      "age": 20,
      "major": "Biology"
    },
    {
      "id": "S102",
      "name": "Bob Smith",
      "age": 22,
      "major": "Fine Arts"
    },
    {
      "id": "S103",
      "name": "Charlie Kim",
      "age": 21,
      "major": "Computer Science"
    }
  ]
}
`;

// Parse the JSON data into a JavaScript object
const data = JSON.parse(jsonData);

// Display the list of events
console.log("📅 Events List:");
data.events.forEach((event) => {
  console.log(`- ${event.title} on ${event.date} at ${event.location}`);
});

// Display the list of student profiles
console.log("\n👩‍🎓 Student Profiles:");
data.students.forEach((student) => {
  console.log(
    `- ${student.name}, Age: ${student.age}, Major: ${student.major}`
  );
});
