# import tkinter as tk
# from tkinter import messagebox

# class AdventureGame:
#     def __init__(self, root):
#         self.root = root
#         self.root.title("Adventure Game")
        
#         self.current_room = "start"
        
#         self.text = tk.Text(self.root, height=15, width=50, wrap='word')
#         self.text.pack()
        
#         self.entry = tk.Entry(self.root, width=50)
#         self.entry.bind("<Return>", self.process_command)
#         self.entry.pack()
        
#         self.text.insert(tk.END, "Welcome to the Adventure Game!\n")
#         self.text.insert(tk.END, self.get_description())
    
#     def get_description(self):
#         descriptions = {
#             "start": "You are in a small room. There is a door to the north.",
#             "hallway": "You are in a hallway. There are doors to the north and south.",
#             "treasure_room": "You found the treasure room! Congratulations!",
#         }
#         return descriptions.get(self.current_room, "There is nothing here.")
    
#     def process_command(self, event):
#         command = self.entry.get().lower()
#         self.entry.delete(0, tk.END)
        
#         if command == "go north":
#             if self.current_room == "start":
#                 self.current_room = "hallway"
#             elif self.current_room == "hallway":
#                 self.current_room = "treasure_room"
#             else:
#                 self.text.insert(tk.END, "You can't go that way.\n")
#         elif command == "go south":
#             if self.current_room == "hallway":
#                 self.current_room = "start"
#             else:
#                 self.text.insert(tk.END, "You can't go that way.\n")
#         else:
#             self.text.insert(tk.END, "I don't understand that command.\n")
        
#         self.text.insert(tk.END, self.get_description() + "\n")

# if __name__ == "__main__":
#     root = tk.Tk()
#     game = AdventureGame(root)
#     root.mainloop()

# Ouvrir un fichier json et afficher tous les champs

import json

def open_json_file(file):
    with open(file, 'r') as f:
        data = json.load(f)
        line = data[0]
        print(line.keys())

        # Met toute les clés dans un fichier CSV
        # with open('keys.csv', 'w') as f:
        #     for key in line.keys():
        #         f.write(f'{key}\n')

        for line in data:
            for key, value in line.items():
            #     if value != None and type(value) != str and key != 'geo_point_2d' and "geo_shape" != key:
            #         print(key, len(value))
                if key == 'delivery':
                    if value != None:
                        print(key, value)
    return data

open_json_file('restaurants_orleans.json')