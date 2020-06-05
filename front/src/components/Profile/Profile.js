import React, {useState, useEffect } from 'react';
import axios from "axios";

export default function Profile() {
    const [user, setUser] = useState({});

    useEffect(() => {
        axios.get('http://localhost:8000/api/users/9')
        .then(function (response) {
            console.log(response.data);
            setUser(response.data);
        })
        .catch(function (error) {
            console.log(error);
        })
    }, [setUser]);

    const handleSubmit = (event) => {
        event.preventDefault();

        axios.put('http://localhost:8000/api/users/9', user)
        .then(function (response) {
            console.log(response);
        })
        .catch(function (error) {
            console.log(error);
        })
    }

    return (
        <div className="text-center">
            <h2>Hey Profile</h2>
            <div className="container">
                <form onSubmit={handleSubmit}>
                    <div className="row">
                        <div className="col-6">
                            <label htmlFor="exampleInputEmail">Email</label>
                            <input type="email" className="form-control" id="exampleInputEmail" value={user.email || ''} onChange={e => setUser({...user, email: e.target.value})}/>
                        </div>
                        <div className="col-6">
                            <label htmlFor="exampleInputFirstName">First name</label>
                            <input type="text" className="form-control" id="exampleInputFirstName" value={user.firstName || ''} onChange={e => setUser({...user, firstName: e.target.value})}/>
                        </div>
                        <div className="col-6">
                            <label htmlFor="exampleInputLastName">First name</label>
                            <input type="text" className="form-control" id="exampleInputLastName" value={user.lastName || ''} onChange={e => setUser({...user, lastName: e.target.value})}/>
                        </div>
                        <div className="col-6">
                            <label htmlFor="exampleInputDescription">Description</label>
                            <input type="text" className="form-control" id="exampleInputDescription" value={user.description || ''} onChange={e => setUser({...user, description: e.target.value})}/>
                        </div>
                        <div className="col-6">
                            <label htmlFor="exampleInputLinkedin">Linkedin</label>
                            <input type="text" className="form-control" id="exampleInputLinkedine" value={user.linkedin || ''} onChange={e => setUser({...user, linkedin: e.target.value})}/>
                        </div>
                        <div className="col-6">
                            <label htmlFor="exampleInputGithub">Github</label>
                            <input type="text" className="form-control" id="exampleInputGithub" value={user.github || ''} onChange={e => setUser({...user, github: e.target.value})}/>
                        </div>
                    </div>
                    <br></br>
                    <button type="submit" className="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    );
}