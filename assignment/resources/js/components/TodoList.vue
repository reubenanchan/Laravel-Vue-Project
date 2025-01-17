<template>
    <div>
      <h1>Todo List</h1>
      <table>
        <thead>
          <tr>
            <th @click="sort('name')">Name</th>
            <th @click="sort('description')">Description</th>
            <th>Created At</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="todo in sortedTodos" :key="todo.id">
            <td>{{ todo.name }}</td>
            <td>{{ todo.description }}</td>
            <td>{{ todo.created_at }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        todos: [],
        sortKey: 'name',  // default sort key
        sortOrder: 'asc',  // default sort order
      };
    },
    computed: {
      sortedTodos() {
        return this.todos.sort((a, b) => {
          if (this.sortOrder === 'asc') {
            return a[this.sortKey] > b[this.sortKey] ? 1 : -1;
          } else {
            return a[this.sortKey] < b[this.sortKey] ? 1 : -1;
          }
        });
      }
    },
    mounted() {
      this.fetchTodos();
    },
    methods: {
      async fetchTodos() {
        try {
          const response = await axios.get('http://localhost/api/todos'); // adjust the URL if needed
          this.todos = response.data;
        } catch (error) {
          console.error('Error fetching todos:', error);
        }
      },
      sort(key) {
        if (this.sortKey === key) {
          this.sortOrder = this.sortOrder === 'asc' ? 'desc' : 'asc';
        } else {
          this.sortKey = key;
          this.sortOrder = 'asc';
        }
      }
    }
  };
  </script>
  
  <style scoped>
  table {
    width: 100%;
    border-collapse: collapse;
  }
  
  th, td {
    padding: 8px;
    text-align: left;
    border: 1px solid #ddd;
  }
  
  th {
    cursor: pointer;
  }
  
  th:hover {
    background-color: #f1f1f1;
  }
  </style>