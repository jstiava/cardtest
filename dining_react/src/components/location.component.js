import React, { Component } from 'react';

class Location extends Component {

 constructor(props) {
  super(props);

  this.clean_title = this.clean_title.bind(this);

  this.state = {
   id: props.id,
   title: this.clean_title(props.location.title.rendered),
   hours: props.location.acf.hours_of_operation,
   hours: props.location.acf.hours_of_operation,
  };
 }

 clean_title(input) {
  var doc = new DOMParser().parseFromString(input, "text/html");
  return doc.documentElement.textContent;
 }

 render() {
  return (
   <div id={this.props.id} className="location">
    <h3>{this.state.title}</h3>
    <p>{this.state.hours}</p>
    <p>{}</p>
   </div>
  )
 }

}

export default Location;