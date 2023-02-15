import "../sass/app.scss"
import "bootstrap/dist/js/bootstrap.bundle.min"
import bootstrap from "bootstrap/dist/js/bootstrap.bundle.min"
import "./sweetalert";
import Search from "./search";
import List from "./list";
import Form from "./form";

window.Vehicles = new List();
window.Search = new Search();
window.Form = Form;
window.bootstrap = bootstrap

Vehicles.load()