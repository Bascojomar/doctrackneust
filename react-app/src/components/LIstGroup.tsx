//list group
import Message from "../message";

function ListGroup() {

let items = [
'basco',
'jomar'
];

items = [];




  return (
<>
    <Message />

    {items.length === 0 && <p>no found item</p>}

    <ul className="list-group">
    {items.map(item => <li key={item}>{item}</li>)}
    </ul>
    </>
  );
  
}


export default ListGroup;
