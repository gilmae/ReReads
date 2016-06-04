<form action="/book/new" method="POST">
  <div>
    <label for="name">Title</label>
    <input id="name" name="name" />
  </div>
  <div>
    <label for="authors">Authors</label>
    <input id="authors" name="authors" />
  </div>
  <div>
    <label for="pages">Page count</label>
    <input id="pages" name="pages" type="number"/>
  </div>
  <div>
    <label for="isbn">ISBN</label>
    <input id="isbn" name="isbn" />
  </div>
  <div>
    <label for="isbn13">ISBN-13</label>
    <input id="isbn13" name="isbn13" />
  </div>
  <div>
    <label for="publisher">Publisher</label>
    <input id="publisher" name="publisher" />
  </div>
  <div>
    <label for="description">Summary</label>
    <textarea id="description" name="description"></textarea>
  </div>
  <input type="submit" value="Save" />
</form>
