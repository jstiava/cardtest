import React, { Component } from 'react';
import Location from './components/location.component';
import './../../style.css';
import './App.css';

class App extends Component {
 constructor(props) {
  super(props);
  this.state = {
   locations: [],
  };
 }

 async componentDidMount() {
  // Run before DOM is loaded
  try {
   const response = await fetch('https://card.local/wp-json/wp/v2/posts?categories=12&per_page=100');
   const json = await response.json();
   this.setState({ locations: json });
  }
  catch (error) {
   console.log(error);
  }
 }

 render() {
  return (
   <div id="content">
    {console.log(this.state.locations)}
    <h3>Locations</h3>
    {
     this.state.locations.map(
      post => {
       return <Location key={post.id} location={post} />;
      }
     )
    }
   </div>
  )
 }
}

export default App;
