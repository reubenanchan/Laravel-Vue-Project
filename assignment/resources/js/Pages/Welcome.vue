<template>
    <div>
      <h1>TODO List</h1>
  
      <!-- Input form to add a new TODO -->
      <div>
        <input v-model="newTodo.name" type="text" placeholder="Enter TODO name" />
        <input v-model="newTodo.description" type="text" placeholder="Enter TODO description" />
        <button @click="addTodo">Add Todo</button>
      </div>
  
      <!-- Display list of TODOs -->
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="todo in todos" :key="todo.id">
            <td>{{ todo.name }}</td>
            <td>{{ todo.description }}</td>
            <td>
              <button @click="editTodo(todo)">Edit</button>
              <button @click="deleteTodo(todo.id)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
  
      <!-- Edit form for the selected TODO -->
      <div v-if="editingTodo">
        <h2>Edit TODO</h2>
        <input v-model="editingTodo.name" type="text" placeholder="Edit TODO name" />
        <input v-model="editingTodo.description" type="text" placeholder="Edit TODO description" />
        <button @click="updateTodo">Save Changes</button>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        todos: [],
        newTodo: {
          name: '',
          description: ''
        },
        editingTodo: null,
      };
    },
    mounted() {
      this.fetchTodos();
    },
    methods: {
      fetchTodos() {
        axios.get('/api/todos').then(response => {
          this.todos = response.data;
        });
      },
      addTodo() {
        if (this.newTodo.name && this.newTodo.description) {
          axios.post('/api/todos', this.newTodo).then(() => {
            this.fetchTodos();
            this.newTodo.name = '';
            this.newTodo.description = '';
          });
        }
      },
      editTodo(todo) {
        this.editingTodo = { ...todo }; // Clone the todo item to edit
      },
      updateTodo() {
        axios.put(`/api/todos/${this.editingTodo.id}`, this.editingTodo).then(() => {
          this.fetchTodos();
          this.editingTodo = null; // Clear the edit form
        });
      },
      deleteTodo(id) {
        axios.delete(`/api/todos/${id}`).then(() => {
          this.fetchTodos();
        });
      },
    },
  };
  </script>