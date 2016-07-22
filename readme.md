### Engineering todo

#### July 21th

- What should CACHE_DRIVER and SESSION_DRIVER for production?
+ FIX: Even if you're logged in you should not see delete shelf or books thing, you should see if it's your shelf
+ FIX: The shelf tests (test that job is dispatched, not silent it)
- Book covers should automatically created from book covers that are in that shelf, use Intervention\Image\ImageManager;
    - on dev env it's using sync, so try redis on beta.booknshelf.com and see how it works.
    + Maybe trigger an event
    + We should be using a queue system (create a task in the queue) so we won't intervent the experience of adding a new book to shelves.
    + Where do we store shelf covers? in s3 and store the url in db with cover field
    - Do we want to store book covers in s3 as well?
    - display the cover when listing the shelf

- The design of bookshelf when you are in it: possibly make two narrow columns listing books
instead of one. 

- Need to be able to add custom books if they don't appear in the search box

- Searched item to remain when you hit search (in case you want to go back and edit it)

- When you are on the page of "My Bookshelves" and create a new bookshelf it doesn't show up unless you refresh the page: need to fix this

- I don't like the symbol that appears once you create the new bookshelf saying "got it". Maybe we can have the new bookshelf show up in a window on the screen instead,giving you option to go the the newly created bookshelf or to close it

- We need to add a sign / button next to the book in the search page that has already been saved to your bookshelf.  This way you can't try to save something twice and you can clearly see that you added the book 

+ Test coverage reports


#### July 19th

- Build the landing page by the design we decided with nyut
    - Make all layout changes
    - Figure out a better shelves layout
    - On hover effect


Later?
- Users should be able to follow a bookshelf and see all following bookshelves in their profile
    - Make sure the code is super clean and has tests.
