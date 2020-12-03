LINKED LIST

#include <iostream>
using namespace std;
struct Node {
   int data;
   struct Node *next;
};
struct Node* head = NULL;
TO INSERT NEW NODE AT BEGINNING
void insert(int new_data) {
   struct Node* new_node = (struct Node*) malloc(sizeof(struct Node));
   new_node->data = new_data;
   new_node->next = head;
   head = new_node;
}

TO INSERT NEW NODE AT THE END
void InsertAtEnd (node* &firstNode, string name)
{
   node* newnode = new node;
   newnode->data=name;
   newnode->next=NULL;

   if(firstNode == NULL)
   {
        firstNode=newnode;
   }
   else
   {
        node* last=firstNode;
        while(last->next != NULL) last=last->next;
        last->next = newnode;
   }
}
TO INSERT AT A GIVEN POSITION
void insertPos(Node** current, int pos, int data)
{
    // This condition to check whether the
    // position given is valid or not.
    if (pos < 1 || pos > size + 1)
        cout << "Invalid position!" << endl;
    else {

        // Keep looping until the pos is zero
        while (pos--) {

            if (pos == 0) {

                // adding Node at required position
                Node* temp = getNode(data);

                // Making the new Node to point to
                // the old Node at the same position
                temp->next = *current;

                // Changing the pointer of the Node previous
                // to the old Node to point to the new Node
                *current = temp;
            }
            else
              // Assign double pointer variable to point to the
              // pointer pointing to the address of next Node
              current = &(*current)->next;
        }
        size++;
    }
}

TO DELETE A NODE AT A SPECIFIC POSITION
void deleteNode(struct Node **head_ref, int position)
{
   // If linked list is empty
   if (*head_ref == NULL)
      return;

   // Store head node
   struct Node* temp = *head_ref;

    // If head needs to be removed
    if (position == 0)
    {
        *head_ref = temp->next;   // Change head
        free(temp);               // free old head
        return;
    }

    // Find previous node of the node to be deleted
    for (int i=0; temp!=NULL && i<position-1; i++)
         temp = temp->next;

    // If position is more than number of nodes
    if (temp == NULL || temp->next == NULL)
         return;

    // Node temp->next is the node to be deleted
    // Store pointer to the next of node to be deleted
    struct Node *next = temp->next->next;

    // Unlink the node from linked list
    free(temp->next);  // Free memory

    temp->next = next;  // Unlink the deleted node from list
}

TO DISPLAY
void display() {
   struct Node* ptr;
   ptr = head;
   while (ptr != NULL) {
      cout<< ptr->data <<" ";
      ptr = ptr->next;
   }
}
TO DELETE ALL THE NODES OF LINKED LIST
void deleteLinkedList(Node** head_ref){
   Node* current = *head_ref;
   Node* next;
   while (current != NULL){
      next = current->next;
      free(current);
      current = next;
   }
   *head_ref = NULL;
}
int main() {
   insert(3); //Calling the function
   insert(1);
   insert(7);
   insert(2);
   insert(9);
   cout<<"The linked list is: ";
   display();
   deleteLinkedList(&head); /// TO DELETE ALL THE NODES
   return 0;
}




CIRCULAR LINKED LIST

#include <iostream>
using namespace std;
struct Node {
   int data;
   struct Node *next;
};
struct Node* head = NULL;
void insert(int newdata) {
   struct Node *newnode = (struct Node *)malloc(sizeof(struct Node));
   struct Node *ptr = head;
   newnode->data = newdata;
   newnode->next = head;
   if (head!= NULL) {
      while (ptr->next != head)
      ptr = ptr->next;
      ptr->next = newnode;
   } else
   newnode->next = newnode;
   head = newnode;
}
void display() {
   struct Node* ptr;
   ptr = head;
   do {
      cout<<ptr->data <<" ";
      ptr = ptr->next;
   } while(ptr != head);
}
int main() {
   insert(3);
   insert(1);
   insert(7);
   insert(2);
   insert(9);
   cout<<"The circular linked list is: ";
   display();
   return 0;
}

HOW TO CONVERT LINKED LIST TO CIRCULAR LINKED LIST

#include <bits/stdc++.h>
//node structure of linked list
struct Node {
   int data;
   struct Node* next;
};
//converting singly linked list
//to circular linked list
struct Node* circular(struct Node* head){
   struct Node* start = head;
   while (head->next != NULL)
      head = head->next;
   //assigning start to the head->next node
   //if head->next points to NULL
   head->next = start;
   return start;
}
void push(struct Node** head, int data){
   //creation of new node
   struct Node* newNode = (struct Node*)malloc
   (sizeof(struct Node));
   //putting data in new node
   newNode->data = data;
   newNode->next = (*head);
   (*head) = newNode;
}
//displaying the elements of circular linked list
void print_list(struct Node* node){
   struct Node* start = node;
   while (node->next != start) {
      printf("%d ", node->data);
      node = node->next;
   }
   printf("%d ", node->data);
}
int main(){
   struct Node* head = NULL;
   push(&head, 15);
   push(&head, 14);
   push(&head, 13);
   push(&head, 22);
   push(&head, 17);
   circular(head);
   printf("Display list: \n");
   print_list(head);
   return 0;
}
CIRCULAR LINKED LIST Insertion at the beginning of the list
To Insert a node at the beginning of the list, follow these step:
1. Create a node, say T.
2. Make T -> next = last -> next.
3. last -> next = T.


struct Node *addBegin(struct Node *last, int data)
{
  if (last == NULL)
     return addToEmpty(last, data);

  // Creating a node dynamically.
  struct Node *temp
        = (struct Node *)malloc(sizeof(struct Node));

  // Assigning the data.
  temp -> data = data;

  // Adjusting the links.
  temp -> next = last -> next;
  last -> next = temp;

  return last;
}

CIRCULAR LINKED LIST Insertion at the end of the list
To Insert a node at the end of the list, follow these step:
1. Create a node, say T.
2. Make T -> next = last -> next;
3. last -> next = T.
4. last = T


struct Node *addEnd(struct Node *last, int data)
{
  if (last == NULL)
     return addToEmpty(last, data);

  // Creating a node dynamically.
  struct Node *temp =
        (struct Node *)malloc(sizeof(struct Node));

  // Assigning the data.
  temp -> data = data;

  // Adjusting the links.
  temp -> next = last -> next;
  last -> next = temp;
  last = temp;

  return last;
}

CIRCULAR LINKED LIST DELETE AN ELEMENT BY KEY


/**
 * Delete all occurrence of an element by key from a
 * given circular linked list.
 */
void deleteAll(struct node ** head, int key)
{
    int i, count;
    struct node *prev, *cur;

    if (*head == NULL)
    {
        printf("List is empty.\n");
        return;
    }

    count = 0;
    cur   = *head;
    prev  = cur;


    // Find node before head node
    while (prev->next != *head)
    {
        prev = prev->next;
        count++;
    }

    // Iterate till first node
    i = 0;
    while (i <= count)
    {
        if (cur->data == key)
        {
            // Link prev node with next node of current
            if (cur->next != cur)
                prev->next = cur->next;
            else
                prev->next = NULL;

            // Adjust head node if needed
            if (cur == *head)
                *head = prev->next;

            // Delete current node
            free(cur);

            // Move current node ahead
            if (prev != NULL)
                cur = prev->next;
            else
                cur = NULL;
        }
        else
        {
            prev = cur;
            cur  = cur->next;
        }


        i++;

    }
}


CIRCULAR LINKED LIST COUNT THE NUMBER OF NODES


/**
 * Function to count total number of nodes in Circular Linked List
 */
int count(struct node *head)
{
    int total = 0;
    struct node *current = head;

    // Iterate till end of list
    do
    {
        current = current->next;
        total++;
    } while (current != head);

    // Return total nodes in list
    return total;
}

CIRCULAR LINKED LIST SEARCH AN ELEMENT

int search(struct node *head, int key)
{
	int index = 0;
    struct node *current = head;

    // Iterate till end of list
    do
    {
		// Nothing to look into
		if (current == NULL)
			return;

		if (current->data == key)
			return index;

        current = current->next;
		index++;
    } while (current != head);

    // Element not found in list
    return -1;
}


CIRCULAR LINKED LIST REVERSE A LIST
void reverseList(struct node **head)
{
    // Temporary helper variables
    struct node *prev, *cur, *next, *last;

    // Cannot reverse empty list
    if (*head == NULL)
    {
        printf("Cannot reverse empty list.\n");
        return;
    }


    // Head is going to be our last node after reversing list
    last = *head;

    prev  = *head;
    cur   = (*head)->next;
    *head = (*head)->next;

    // Iterate till you reach the initial node in circular list
    while (*head != last)
    {
        *head = (*head)->next;
        cur->next = prev;

        prev = cur;
        cur  = *head;
    }

    cur->next = prev;
    *head = prev;       // Make last node as head
}
