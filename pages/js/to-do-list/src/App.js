import React, { useState } from 'react';
import logo from './logo.svg';
import './App.css';
import Task from './Task/Task';

function App() {
  const[tasks, setTasks] = useState([]);

  function fetchTasksHandler(){
    fetch('../../php/controller').then(response => {
      return response.json();
    })
    .then(data => {
      const transformedTask = data.results.map(taskData =>{
        return {
          id: taskData.taskId,
          name: taskData.name
        };
      });
      setTasks(transformedTask);
    });
  }

  return (
    <div className="App">
      <Task task={tasks}/>
    </div>
  );
}

export default App;