using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using LIMS.Models;

namespace LIMS.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class AmostraController : ControllerBase
    {
        private readonly LimsContext _context;

        public AmostraController(LimsContext context)
        {
            _context = context;
        }

        // GET: api/Amostra
        [HttpGet]
        public async Task<ActionResult<IEnumerable<Amostra>>> GetAmostra()
        {
            return await _context.Amostra
                .Include(u => u.Usuario)
                .Include(a => a.Analise)
                .ToListAsync();
        }

        // GET: api/Amostra/5
        [HttpGet("{id}")]
        public async Task<ActionResult<Amostra>> GetAmostra(int id)
        {
            var amostra = await _context.Amostra.FindAsync(id);

            if (amostra == null)
            {
                return NotFound();
            }

            return amostra;
        }

        // PUT: api/Amostra/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for
        // more details see https://aka.ms/RazorPagesCRUD.
        [HttpPut("{id}")]
        public async Task<IActionResult> PutAmostra(int id, Amostra amostra)
        {
            if (id != amostra.Id)
            {
                return BadRequest();
            }

            _context.Entry(amostra).State = EntityState.Modified;

            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!AmostraExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return NoContent();
        }

        // POST: api/Amostra
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for
        // more details see https://aka.ms/RazorPagesCRUD.
        [HttpPost]
        public async Task<ActionResult<Amostra>> PostAmostra(Amostra amostra)
        {
            _context.Amostra.Add(amostra);
            await _context.SaveChangesAsync();

            return CreatedAtAction("GetAmostra", new { id = amostra.Id }, amostra);
        }

        // DELETE: api/Amostra/5
        [HttpDelete("{id}")]
        public async Task<ActionResult<Amostra>> DeleteAmostra(int id)
        {
            var amostra = await _context.Amostra.FindAsync(id);
            if (amostra == null)
            {
                return NotFound();
            }

            _context.Amostra.Remove(amostra);
            await _context.SaveChangesAsync();

            return amostra;
        }

        private bool AmostraExists(int id)
        {
            return _context.Amostra.Any(e => e.Id == id);
        }
    }
}
