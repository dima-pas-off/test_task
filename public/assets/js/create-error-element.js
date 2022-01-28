function createErrorElement(rootNode, info) {
    let errorField = document.createElement("p");
    errorField.innerHTML = info;
    rootNode.append(errorField);
}